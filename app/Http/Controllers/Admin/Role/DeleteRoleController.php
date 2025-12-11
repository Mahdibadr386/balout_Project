<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\RolePermission\RoleRepository;
use Spatie\Permission\Models\Role;

class DeleteRoleController extends Controller
{
    public function __invoke(Role $role, RoleRepository $RoleRepository)
    {
        $RoleRepository->delete($role);

        return response()->success('نقش‌ها با موفقیت حذف شدند');

    }
}
