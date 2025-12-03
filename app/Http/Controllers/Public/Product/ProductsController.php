<?php

namespace App\Http\Controllers\Public\Product;


use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductCollection;
use App\Repositories\Public\Product\ProductRepository;


class ProductsController extends Controller
{
    public function __invoke(ProductRepository $productRepository)
    {
        $products = $productRepository->products();

        return response()->success(new ProductCollection($products), 'اطلاعات محصولات با موفقیت دریافت شد', 200);

    }
}
