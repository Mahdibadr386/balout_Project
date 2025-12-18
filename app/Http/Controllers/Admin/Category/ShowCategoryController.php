<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Interface\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class ShowCategoryController extends Controller
{
    public function __invoke(Request $request, CategoryRepositoryInterface $CategoryRepository)
    {
        auth()->user()->hasPermissionTo('category.show') ?: abort(403);
        $category = $CategoryRepository->find($request->id);

        if(!$category) {
            return response()->error('دسته‌بندی با موفقیت دریافت نشد');
        }else{
            return response()->success( 'دسته‌بندی با موفقیت دریافت شد' ,new CategoryResource($category));
        }

    }
}
