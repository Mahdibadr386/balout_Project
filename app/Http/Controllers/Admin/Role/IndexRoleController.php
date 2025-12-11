<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Repositories\Admin\RolePermission\RoleRepository;

class IndexRoleController extends Controller
{
    public function __invoke(RoleRepository $RoleRepository)
    {
        return response()->success('لیست نقش‌ها با موفقیت دریافت شد', RoleResource::collection($RoleRepository->getAll()));
    }
}
