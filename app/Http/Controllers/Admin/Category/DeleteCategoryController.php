<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Category\CategoryResource;
use App\Repositories\Admin\Category\CategoryRepository;
use Illuminate\Http\Request;

class DeleteCategoryController extends Controller
{
    public function __invoke( CategoryRepository $repo, $id)
    {
        $category = $repo->delete($id);

        return response()->success('دسته‌بندی با موفقیت حذف شد' , 200);

    }
}
