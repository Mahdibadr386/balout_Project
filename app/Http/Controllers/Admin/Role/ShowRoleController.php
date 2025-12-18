<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Interface\RoleRepositoryInterface;

class ShowRoleController extends Controller
{
    public function __invoke($id, RoleRepositoryInterface $RoleRepository)
    {
        auth()->user()->hasPermissionTo('role.show') ?: abort(403);
        return response()->success( ' نقش با موفقیت دریافت شد', new RoleResource($RoleRepository->getById($id)));
    }
}
