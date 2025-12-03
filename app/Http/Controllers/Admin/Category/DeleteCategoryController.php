<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Category\CategoryRepository;


class DeleteCategoryController extends Controller
{
    public function __invoke( CategoryRepository $CategoryRepository, $id)
    {
        $CategoryRepository->delete($id);

        return response()->success('دسته‌بندی با موفقیت حذف شد' , 200);

    }
}
