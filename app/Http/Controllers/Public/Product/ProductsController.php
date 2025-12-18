<?php

namespace App\Http\Controllers\Public\Product;


use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductCollection;
use App\Interface\ProductRepositoryInterface;
use Illuminate\Http\Request;


class ProductsController extends Controller
{
    public function __invoke(Request $request,ProductRepositoryInterface $productRepository)
    {
        $filters = $request->only([
            'search',
            'category_slug',
            'min_price',
            'max_price',
            'sort',
            'per_page',
        ]);

        $products = $productRepository->Products($filters);

        return response()->success( 'اطلاعات محصولات با موفقیت دریافت شد', new ProductCollection($products));

    }
}
