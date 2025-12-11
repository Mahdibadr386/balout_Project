<?php

namespace App\Http\Controllers\Public\Category;


use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Category\CategoryResource;
use App\Repositories\Public\Category\CategoryRepository;


class CategoriesController extends Controller
{
    public function __invoke(CategoryRepository $categoryRepository)
    {
        $categories = $categoryRepository->all();

        return response()->success( 'لیست دسته‌بندی‌ها با موفقیت دریافت شد' ,CategoryResource::collection($categories),);

    }

}
