<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryCollection;
use App\Repositories\Category\CategoryRepositoryInterface;

class IndexCategoriesController extends Controller
{
    public function __invoke(CategoryRepositoryInterface $CategoryRepository)
    {
        $categories = $CategoryRepository->all();

        return response()->success( 'لیست دسته‌بندی‌ها با موفقیت دریافت شد' ,new CategoryCollection($categories),);

    }
}
