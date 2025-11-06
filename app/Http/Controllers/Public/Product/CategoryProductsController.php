<?php

namespace App\Http\Controllers\Public\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductCollection;
use App\Repositories\Public\Product\ProductRepository;


class CategoryProductsController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(string $slug)
    {
        $products = $this->productRepository->categoryProducts($slug);

        if ($products === null) return response()->error('دسته‌بندی مورد نظر یافت نشد', null, 404);
        if ($products->isEmpty()) return response()->error('هیچ محصولی در این دسته‌بندی یافت نشد', null, 404);

        return response()->success(new ProductCollection($products), 'اطلاعات محصولات با موفقیت دریافت شد', 200);
    }


}
