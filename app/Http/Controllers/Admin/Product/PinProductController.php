<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Interface\ProductRepositoryInterface;

class PinProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository , $id)
    {
        auth()->user()->hasPermissionTo('product.pin') ?: abort(403);

        if (!$ProductRepository->find($id)) {
            return response()->error('محصول مورد نظر پیدا نشد', );
        }
        else{
            $product = $ProductRepository->pinProduct($id);
            return response()->success('محصول با موفقیت در بالا قرار داده شد', new ProductResource($product));
        }

    }
}
