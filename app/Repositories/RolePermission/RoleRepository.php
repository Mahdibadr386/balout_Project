<?php

namespace App\Repositories\RolePermission;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAll()
    {
        return Role::withCount(['users', 'permissions'])->get();
    }

    public function getById($id)
    {
        return Role::with(['permissions', 'users'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create([
                'name' => $data['name'],
                'guard_name' => $data['guard_name'] ?? 'api',
            ]);


            if (!empty($data['permissions'])) {

                $permissionNames = collect($data['permissions'])->map(function ($perm) {
                    if (is_numeric($perm)) {
                        $permission = Permission::find($perm);
                        if (!$permission) {
                            throw new \Exception("Permission with ID {$perm} not found.");
                        }
                        return $permission->name;
                    }
                    return $perm;
                })->toArray();


                $role->syncPermissions($permissionNames);
            }

            return $role;
        });
    }


    public function update(Role $role, array $data)
    {
        return DB::transaction(function () use ($role, $data) {
            if (isset($data['name'])) {
                $role->name = $data['name'];
            }

            if (isset($data['guard_name'])) {
                $role->guard_name = $data['guard_name'];
            }

            $role->save();


            if (!empty($data['permissions'])) {
                $permissionNames = collect($data['permissions'])->map(function ($perm) {
                    if (is_numeric($perm)) {
                        $permission = Permission::find($perm);
                        if (!$permission) {
                            throw new \Exception("Permission with ID {$perm} not found.");
                        }
                        return $permission->name;
                    }
                    return $perm;
                })->toArray();

                $role->syncPermissions($permissionNames);
            }

            return $role->load('permissions');
        });
    }


    public function delete(Role $role)
    {
        if ($role->users()->count() > 0) {
            throw new \Exception('این نقش به کاربر اختصاص داده شده و قابل حذف نیست.');
        }

        $role->delete();
    }

    public function assignRoleToUsers(Role $role, array $userIds)
    {
        $users = User::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            $user->syncRoles($role);
        }

        return $role->load('users');
    }


}
