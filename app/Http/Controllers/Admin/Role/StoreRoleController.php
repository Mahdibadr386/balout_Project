<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRoleRequest;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Interface\RoleRepositoryInterface;

class StoreRoleController extends Controller
{
    public function __invoke(StoreRoleRequest $request, RoleRepositoryInterface $RoleRepository)
    {
        auth()->user()->hasPermissionTo('role.store') ?: abort(403);
        return response()->success( 'نقش با موفقیت ایجاد شد',new RoleResource($RoleRepository->create($request->validated())), 201);
    }
}
