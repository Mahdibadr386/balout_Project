<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Interface\ProductRepositoryInterface;


class DeleteProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository,$id)
    {
        auth()->user()->hasPermissionTo('product.delete') ?: abort(403);
        $product = $ProductRepository->find($id);
        if (!$product) return response()->error('محصول یافت نشد');

        $ProductRepository->delete($product);
        return response()->success( 'محصول با موفقیت حذف شد');
    }
}
