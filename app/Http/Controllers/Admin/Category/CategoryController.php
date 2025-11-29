<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Admin\Category\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __invoke(Request $request, CategoryRepository $repo)
    {
        $category = $repo->find($request->id);

        if(!$category) {
            return response()->success( 'دسته‌بندی با موفقیت دریافت نشد', 404);
        }else{
            return response()->success(new CategoryResource($category), 'دسته‌بندی با موفقیت دریافت شد', 200);
        }

    }
}
