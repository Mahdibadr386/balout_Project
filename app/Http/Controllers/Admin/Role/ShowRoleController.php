<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Repositories\RolePermission\RoleRepositoryInterface;

class ShowRoleController extends Controller
{
    public function __invoke($id, RoleRepositoryInterface $RoleRepository)
    {
        return response()->success( ' نقش با موفقیت دریافت شد', new RoleResource($RoleRepository->getById($id)));
    }
}
