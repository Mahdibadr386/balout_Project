<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryUpdateRequest;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Admin\Category\CategoryRepository;

class UpdateCategoryController extends Controller
{
    public function __invoke(CategoryUpdateRequest $request, CategoryRepository $CategoryRepository, $id)
    {
        $category = $CategoryRepository->update($id, $request->validated());

        return response()->success(new CategoryResource($category), 'دسته‌بندی با موفقیت بروزرسانی شد', 200);

    }
}
