<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;


class DeleteProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository,$id)
    {
        $product = $ProductRepository->find($id);
        if (!$product) return response()->error('محصول یافت نشد');

        $ProductRepository->delete($product);
        return response()->success( 'محصول با موفقیت حذف شد');
    }
}
