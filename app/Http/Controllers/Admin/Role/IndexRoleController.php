<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Interface\RoleRepositoryInterface;

class IndexRoleController extends Controller
{
    public function __invoke(RoleRepositoryInterface $RoleRepository)
    {
        auth()->user()->hasPermissionTo('role.index') ?: abort(403);
        return response()->success('لیست نقش‌ها با موفقیت دریافت شد', RoleResource::collection($RoleRepository->getAll()));
    }
}
