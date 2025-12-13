<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Repositories\RolePermission\RoleRepositoryInterface;

class IndexRoleController extends Controller
{
    public function __invoke(RoleRepositoryInterface $RoleRepository)
    {
        return response()->success('لیست نقش‌ها با موفقیت دریافت شد', RoleResource::collection($RoleRepository->getAll()));
    }
}
