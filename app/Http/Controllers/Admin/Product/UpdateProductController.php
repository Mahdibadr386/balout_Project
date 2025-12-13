<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Product\ProductRepositoryInterface;


class UpdateProductController extends Controller
{
    public function __invoke(ProductRepositoryInterface $ProductRepository,UpdateProductRequest $request, $id)
    {
        $product = $ProductRepository->find($id);
        if (!$product) return response()->error('محصول یافت نشد');

        return response()->success('محصول با موفقیت بروزرسانی شد',new ProductResource($ProductRepository->update($product, $request->validated())));
    }
}
