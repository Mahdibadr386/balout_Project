<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryCollection;
use App\Interface\CategoryRepositoryInterface;

class IndexCategoriesController extends Controller
{
    public function __invoke(CategoryRepositoryInterface $CategoryRepository)
    {
        auth()->user()->hasPermissionTo('category.index') ?: abort(403);
        $categories = $CategoryRepository->all();

        return response()->success( 'لیست دسته‌بندی‌ها با موفقیت دریافت شد' ,new CategoryCollection($categories),);

    }
}
