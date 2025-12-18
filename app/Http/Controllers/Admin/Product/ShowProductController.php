<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Interface\ProductRepositoryInterface;

class ShowProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository, $id)
    {
        auth()->user()->hasPermissionTo('product.show') ?: abort(403);
        $product = $ProductRepository->find($id);
        if ($product) {
            $product->load('media');
        }

        return $product
            ? response()->success( 'محصول یافت شد' , new ProductResource($product))
            : response()->error('محصول یافت نشد');
    }
}
