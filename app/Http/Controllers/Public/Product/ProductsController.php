<?php

namespace App\Http\Controllers\Public\Product;


use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductCollection;
use App\Repositories\Product\ProductRepositoryInterface;


class ProductsController extends Controller
{
    public function __invoke(ProductRepositoryInterface $productRepository)
    {
        $products = $productRepository->products();

        return response()->success( 'اطلاعات محصولات با موفقیت دریافت شد', new ProductCollection($products));

    }
}
