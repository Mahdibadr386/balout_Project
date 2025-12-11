<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Permission\StorePermissionRequest;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Repositories\Admin\RolePermission\PermissionRepository;
use Illuminate\Http\Request;

class StorePermissionController extends Controller
{
    public function __invoke(StorePermissionRequest $request, PermissionRepository $PermissionRepository)
    {
        return response()->success('مجوز با موفقیت ایجاد شد',new PermissionResource($PermissionRepository->create($request->validated())),  201);
    }
}
