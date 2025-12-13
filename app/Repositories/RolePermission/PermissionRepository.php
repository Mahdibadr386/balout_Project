<?php

namespace App\Repositories\RolePermission;

use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAll()
    {
        return Permission::orderBy('id')->paginate(20);
    }

    public function getById($id)
    {
        return Permission::with('roles')->findOrFail($id);
    }

}
