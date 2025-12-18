<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Permission\PermissionResource;
use App\Interface\PermissionRepositoryInterface;

class IndexPermissionController extends Controller
{
    public function __invoke(PermissionRepositoryInterface $PermissionRepository)
    {
        auth()->user()->hasPermissionTo('permission.index') ?: abort(403);

        return response()->success( 'لیست مجوزها با موفقیت دریافت شد', PermissionResource::collection($PermissionRepository->getAll()->flatten()));
    }
}
