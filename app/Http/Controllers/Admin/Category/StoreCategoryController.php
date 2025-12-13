<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryStoreRequest;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Category\CategoryRepositoryInterface;


class StoreCategoryController extends Controller
{
    public function __invoke(CategoryStoreRequest $request, CategoryRepositoryInterface $CategoryRepository)
    {
        $category = $CategoryRepository->create($request->validated());

        return response()->success( 'دسته‌بندی با موفقیت ایجاد شد',new CategoryResource($category), 201);

    }
}
