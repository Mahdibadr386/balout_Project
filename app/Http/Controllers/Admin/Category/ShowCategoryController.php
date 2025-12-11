<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Admin\Category\CategoryRepository;
use Illuminate\Http\Request;

class ShowCategoryController extends Controller
{
    public function __invoke(Request $request, CategoryRepository $CategoryRepository)
    {
        $category = $CategoryRepository->find($request->id);

        if(!$category) {
            return response()->error('دسته‌بندی با موفقیت دریافت نشد');
        }else{
            return response()->success( 'دسته‌بندی با موفقیت دریافت شد' ,new CategoryResource($category));
        }

    }
}
