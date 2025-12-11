<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Repositories\Admin\RolePermission\RoleRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UpdateRoleController extends Controller
{
    public function __invoke(UpdateRoleRequest $request, Role $role, RoleRepository $RoleRepository)
    {
        return response()->success( 'نقش با موفقیت بروزرسانی شد', new RoleResource($RoleRepository->update($role, $request->validated())));
    }
}
