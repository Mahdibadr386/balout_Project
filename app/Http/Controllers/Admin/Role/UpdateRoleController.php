<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\UpdateRoleRequest;
use App\Http\Resources\Admin\Role\RoleResource;
use App\Interface\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class UpdateRoleController extends Controller
{
    public function __invoke(UpdateRoleRequest $request, $id, RoleRepositoryInterface $RoleRepository)
    {
        auth()->user()->hasPermissionTo('role.update') ?: abort(403);
        $role = $RoleRepository->getById($id);

        return response()->success( 'نقش با موفقیت بروزرسانی شد', new RoleResource($RoleRepository->update($role, $request->validated())));


    }
}
