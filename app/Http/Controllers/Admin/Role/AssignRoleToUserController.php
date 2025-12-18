<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\AssignRoleRequest;
use App\Interface\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class AssignRoleToUserController extends Controller
{
    public function __invoke(AssignRoleRequest $request, Role $role, RoleRepositoryInterface $RoleRepository)
    {
        auth()->user()->hasPermissionTo('role.assign') ?: abort(403);
        $RoleRepository->assignRoleToUsers($role, $request->validated()['users']);

        return response()->success('نقش‌ها با موفقیت اختصاص داده شدند');
    }
}
