<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\UpdatePermissionRequest;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Repositories\Admin\RolePermission\PermissionRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class UpdatePermissionController extends Controller
{
    public function __invoke(UpdatePermissionRequest $request, Permission $permission, PermissionRepository $PermissionRepository)
    {
        return response()->success( 'مجوز با موفقیت بروزرسانی شد',new PermissionResource($PermissionRepository->update($permission, $request->validated())),);
    }
}
