<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Interface\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class DeleteRoleController extends Controller
{
    public function __invoke(Role $role, RoleRepositoryInterface $RoleRepository)
    {
        auth()->user()->hasPermissionTo('role.delete') ?: abort(403);
        $RoleRepository->delete($role);

        return response()->success('نقش‌ها با موفقیت حذف شدند');

    }
}
