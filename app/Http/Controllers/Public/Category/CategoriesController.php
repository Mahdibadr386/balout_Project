<?php

namespace App\Http\Controllers\Public\Category;


use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Category\CategoryResource;
use App\Repositories\Category\CategoryRepositoryInterface;


class CategoriesController extends Controller
{
    public function __invoke(CategoryRepositoryInterface $categoryRepository)
    {
        $categories = $categoryRepository->active();

        return response()->success( 'لیست دسته‌بندی‌ها با موفقیت دریافت شد' ,CategoryResource::collection($categories),);

    }

}
