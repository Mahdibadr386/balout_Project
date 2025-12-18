<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Interface\ProductRepositoryInterface;

class ActiveStatusProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository , $id)
    {
        auth()->user()->hasPermissionTo('product.change_status') ?: abort(403);
        $product = $ProductRepository->find($id);

        if (!$product) return response()->error('محصول یافت نشد');
        $ProductRepository->ActiveStatus($product);
        return response()->success( 'محصول با موفقیت تغییر حالت داده شد', new ProductResource($product));
    }
}
