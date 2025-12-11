<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Repositories\Admin\RolePermission\PermissionRepository;

class ShowPermissionController extends Controller
{
    public function __invoke($id, PermissionRepository $PermissionRepository)
    {
        return response()->success( ' مجوز با موفقیت دریافت شد',new PermissionResource($PermissionRepository->getById($id)));
    }
}
