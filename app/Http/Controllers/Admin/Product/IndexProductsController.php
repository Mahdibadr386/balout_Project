<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;

class IndexProductsController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository)
    {
        return response()->success( 'لیست محصولات با موفقیت دریافت شد' , ProductResource::collection($ProductRepository->all()));
    }
}
