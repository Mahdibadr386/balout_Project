<?php

namespace App\Repositories\Mysql;

use App\Interface\PermissionRepositoryInterface;
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
