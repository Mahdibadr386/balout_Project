<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;

class IndexProductsController extends Controller
{
    public function __invoke(ProductRepository $ProductRepository)
    {
        return response()->success( 'لیست محصولات با موفقیت دریافت شد' , ProductResource::collection($ProductRepository->all()));
    }
}
