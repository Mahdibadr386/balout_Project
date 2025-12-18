<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Interface\ProductRepositoryInterface;

class StoreProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository,StoreProductRequest $request)
    {
        auth()->user()->hasPermissionTo('product.store') ?: abort(403);
        $product = $ProductRepository->create($request->validated());
        return response()->success( 'محصول با موفقیت ساخته شد',new ProductResource($product), 201);
    }
}
