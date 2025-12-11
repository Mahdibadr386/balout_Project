<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Admin\Category\CategoryRepository;


class StoreCategoryController extends Controller
{
    public function __invoke(CategoryStoreRequest $request, CategoryRepository $CategoryRepository)
    {
        $category = $CategoryRepository->create($request->validated());

        return response()->success( 'دسته‌بندی با موفقیت ایجاد شد',new CategoryResource($category), 201);

    }
}
