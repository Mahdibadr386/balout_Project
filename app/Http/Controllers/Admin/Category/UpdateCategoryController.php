<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Category\CategoryRepositoryInterface;

class UpdateCategoryController extends Controller
{
    public function __invoke(CategoryUpdateRequest $request, CategoryRepositoryInterface $CategoryRepository, $id)
    {
        $category = $CategoryRepository->update($id, $request->validated());

        return response()->success( 'دسته‌بندی با موفقیت بروزرسانی شد',new CategoryResource($category), 200);

    }
}
