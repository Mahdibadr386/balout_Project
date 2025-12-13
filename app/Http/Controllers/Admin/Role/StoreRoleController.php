<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Repositories\RolePermission\RoleRepositoryInterface;

class StoreRoleController extends Controller
{
    public function __invoke(StoreRoleRequest $request, RoleRepositoryInterface $RoleRepository)
    {
        return response()->success( 'نقش با موفقیت ایجاد شد',new RoleResource($RoleRepository->create($request->validated())), 201);
    }
}
