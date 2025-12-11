<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\RolePermission\PermissionRepository;

class DeletePermissionController extends Controller
{
    public function __invoke($permission, PermissionRepository $PermissionRepository)
    {
        $PermissionRepository->delete($permission);

        return response()->success( 'مجوز با موفقیت حذف شد.' );
    }
}
