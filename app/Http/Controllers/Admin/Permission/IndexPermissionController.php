<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Repositories\RolePermission\PermissionRepositoryInterface;

class IndexPermissionController extends Controller
{
    public function __invoke(PermissionRepositoryInterface $PermissionRepository)
    {
        return response()->success( 'لیست مجوزها با موفقیت دریافت شد', PermissionResource::collection($PermissionRepository->getAll()->flatten()));
    }
}
