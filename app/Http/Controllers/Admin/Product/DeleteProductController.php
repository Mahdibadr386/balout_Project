<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Product\ProductRepository;


class DeleteProductController extends Controller
{
    public function __invoke(ProductRepository $ProductRepository,$id)
    {
        $product = $ProductRepository->find($id);
        if (!$product) return response()->error('محصول یافت نشد', null, 404);

        $ProductRepository->delete($product);
        return response()->success(null, 'محصول با موفقیت حذف شد',200);
    }
}
