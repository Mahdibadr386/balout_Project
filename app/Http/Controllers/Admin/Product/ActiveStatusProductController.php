<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;
use Illuminate\Http\Request;

class ActiveStatusProductController extends Controller
{
    public function __invoke(ProductRepository $ProductRepository , $id)
    {
        $product = $ProductRepository->find($id);

        if (!$product) return response()->error('محصول یافت نشد');
        $ProductRepository->ActiveStatus($product);
        return response()->success( 'محصول با موفقیت تغییر حالت داده شد', new ProductResource($product));
    }
}
