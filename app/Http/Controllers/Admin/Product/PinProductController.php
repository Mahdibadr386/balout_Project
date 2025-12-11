<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;
use Illuminate\Http\Request;

class PinProductController extends Controller
{
    public function __invoke(ProductRepository $ProductRepository , $id)
    {
        $product = $ProductRepository->pinProduct($id);
        return response()->success('محصول با موفقیت در بالا قرار داده شد', new ProductResource($product));
    }
}
