<?php

namespace App\Http\Controllers\Public\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductCollection;
use App\Repositories\Product\ProductRepositoryInterface;


class CategoryProductsController extends Controller
{
    public function __invoke(ProductRepositoryInterface $productRepository  ,string $slug)
    {
        $products = $productRepository->categoryProducts($slug);

        if ($products === null) return response()->error('دسته‌بندی مورد نظر یافت نشد');
        if ($products->isEmpty()) return response()->error('هیچ محصولی در این دسته‌بندی یافت نشد');

        return response()->success( 'اطلاعات محصولات با موفقیت دریافت شد',new ProductCollection($products) );
    }


}
