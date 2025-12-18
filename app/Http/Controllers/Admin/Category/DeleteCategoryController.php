<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Interface\CategoryRepositoryInterface;


class DeleteCategoryController extends Controller
{
    public function __invoke( CategoryRepositoryInterface $CategoryRepository, $id)
    {
        auth()->user()->hasPermissionTo('category.delete') ?: abort(403);
        $CategoryRepository->delete($id);

        return response()->success('دسته‌بندی با موفقیت حذف شد');

    }
}
