<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryCollection;
use App\Repositories\Admin\Category\CategoryRepository;

class IndexCategoriesController extends Controller
{
    public function __invoke(CategoryRepository $CategoryRepository)
    {
        $categories = $CategoryRepository->paginate();

        return response()->success(new CategoryCollection($categories), 'لیست دسته‌بندی‌ها با موفقیت دریافت شد', 200);

    }
}
