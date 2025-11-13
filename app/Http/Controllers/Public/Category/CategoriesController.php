<?php

namespace App\Http\Controllers\Public\Category;


use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Category\CategoryResource;
use App\Repositories\Public\Category\CategoryRepository;


class CategoriesController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function __invoke()
    {
        $categories = $this->categoryRepository->all();

        return response()->success(CategoryResource::collection($categories), 'لیست دسته‌بندی‌ها با موفقیت دریافت شد');

    }

}
