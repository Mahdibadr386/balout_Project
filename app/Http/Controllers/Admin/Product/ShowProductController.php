<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;

class ShowProductController extends Controller
{
    public function __invoke(ProductRepository $ProductRepository, $id)
    {
        $product = $ProductRepository->find($id);
        if ($product) {
            $product->load('media');
        }

        return $product
            ? response()->success(new ProductResource($product) , 'محصول یافت شد' , 200)
            : response()->error('محصول یافت نشد', null, 404);
    }
}
