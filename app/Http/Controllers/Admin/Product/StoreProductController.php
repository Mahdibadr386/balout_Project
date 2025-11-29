<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;
use Illuminate\Http\Request;

class StoreProductController extends Controller
{
    public function __construct(protected ProductRepository $repository) {}

    public function __invoke(StoreProductRequest $request)
    {
        $product = $this->repository->create($request->validated());
        return response()->success(new ProductResource($product), 'محصول با موفقیت ساخته شد', 201);
    }
}
