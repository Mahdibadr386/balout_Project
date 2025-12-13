<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;

class PinProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository , $id)
    {
        $product = $ProductRepository->pinProduct($id);
        return response()->success('محصول با موفقیت در بالا قرار داده شد', new ProductResource($product));
    }
}
