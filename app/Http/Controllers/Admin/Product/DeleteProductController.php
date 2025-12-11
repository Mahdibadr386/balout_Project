<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Product\ProductRepository;


class DeleteProductController extends Controller
{
    public function __invoke(ProductRepository $ProductRepository,$id)
    {
        $product = $ProductRepository->find($id);
        if (!$product) return response()->error('محصول یافت نشد');

        $ProductRepository->delete($product);
        return response()->success( 'محصول با موفقیت حذف شد');
    }
}
