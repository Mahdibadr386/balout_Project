<?php

namespace App\Http\Controllers\Public\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Product\ProductResource;
use App\Repositories\Public\Product\ProductRepository;


class ShowProductController extends Controller
{

    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function __invoke(string $slug)
    {
        $product = $this->productRepository->product($slug);


        if ($product === null) return response()->error('محصول مورد نظر یافت نشد', null, 404);

        return response()->success(new ProductResource($product), 'اطلاعات محصول با موفقیت دریافت شد', 200);

    }
}
