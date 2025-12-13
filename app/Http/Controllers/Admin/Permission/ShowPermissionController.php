<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Repositories\RolePermission\PermissionRepositoryInterface;

class ShowPermissionController extends Controller
{
    public function __invoke($id, PermissionRepositoryInterface $PermissionRepository)
    {
        return response()->success( ' مجوز با موفقیت دریافت شد',new PermissionResource($PermissionRepository->getById($id)));
    }
}
