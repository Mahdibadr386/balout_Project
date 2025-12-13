<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Repositories\RolePermission\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class DeleteRoleController extends Controller
{
    public function __invoke(Role $role, RoleRepositoryInterface $RoleRepository)
    {
        $RoleRepository->delete($role);

        return response()->success('نقش‌ها با موفقیت حذف شدند');

    }
}
