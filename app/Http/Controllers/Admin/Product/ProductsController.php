<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function __construct(protected ProductRepository $repository) {}

    public function __invoke()
    {
        return response()->success(ProductResource::collection($this->repository->all()) , 'لیست محصولات با موفقیت دریافت شد' , 200);
    }
}
