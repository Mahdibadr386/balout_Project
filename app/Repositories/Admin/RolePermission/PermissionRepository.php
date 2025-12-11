<?php

namespace App\Repositories\Admin\RolePermission;

use Spatie\Permission\Models\Permission;

class PermissionRepository
{
    public function getAll()
    {
        return Permission::orderBy('id')->get();
    }

    public function getById($id)
    {
        return Permission::with('roles')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Permission::create([
            'name' => $data['name'],
            'guard_name' => 'api',
        ]);
    }

    public function update(Permission $permission, array $data)
    {
        $permission->update([
            'name' => $data['name'],
            'guard_name' => 'api',
        ]);
        return $permission->fresh();
    }

    public function delete(int $permission)
    {
        $permission = Permission::find($permission);
        if (!$permission) {
            throw new \Exception('این مجوز وجود ندارد یا قابل حذف نیست.');
        }

        if ($permission->roles()->exists()) {
            throw new \Exception('این مجوز به نقش‌ها اختصاص دارد و قابل حذف نیست.');
        }

        try {
            if (method_exists($permission, 'users') && $permission->users()->exists()) {
                throw new \Exception('این مجوز به کاربران اختصاص دارد و قابل حذف نیست.');
            }
        } catch (\Exception $e) {

        }


        $permission->delete();
    }

}
