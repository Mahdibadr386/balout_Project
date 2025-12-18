<?php

namespace App\Http\Controllers\Public\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductResource;
use App\Interface\ProductRepositoryInterface;


class ShowProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $productRepository , string $slug)
    {
        $product = $productRepository->product($slug);

        if ($product === null) return response()->error('محصول مورد نظر یافت نشد');

        return response()->success('اطلاعات محصول با موفقیت دریافت شد', new ProductResource($product));
    }
}
