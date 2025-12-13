<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;


class DeleteCategoryController extends Controller
{
    public function __invoke( CategoryRepositoryInterface $CategoryRepository, $id)
    {
        $CategoryRepository->delete($id);

        return response()->success('دسته‌بندی با موفقیت حذف شد');

    }
}
