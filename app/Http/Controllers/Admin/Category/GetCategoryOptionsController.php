<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Option\OptionResource;
use App\Repositories\Admin\Category\CategoryRepository;
use Illuminate\Http\Request;

class GetCategoryOptionsController extends Controller
{
    public function __invoke(CategoryRepository $CategoryRepository , $id)
    {
        $category = $CategoryRepository->find($id);

        if(!$category) {
            return response()->error('دسته‌بندی با موفقیت دریافت نشد');
        }else{
            $result = $CategoryRepository->getCategoryOptions($id);
            return response()->success('اپشن های دسته‌بندی با موفقیت دریافت شد' ,OptionResource::collection($result), );
        }
    }
}
