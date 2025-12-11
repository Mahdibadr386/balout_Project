<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\AssignRoleRequest;
use App\Repositories\Admin\RolePermission\RoleRepository;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AssignRoleToUserController extends Controller
{
    public function __invoke(AssignRoleRequest $request, Role $role, RoleRepository $RoleRepository)
    {
        $RoleRepository->assignRoleToUsers($role, $request->validated()['users']);

        return response()->success('نقش‌ها با موفقیت اختصاص داده شدند');
    }
}
