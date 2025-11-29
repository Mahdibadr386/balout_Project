<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;
use Illuminate\Http\Request;

class UpdateProductController extends Controller
{
    public function __construct(protected ProductRepository $repository) {}

    public function __invoke(UpdateProductRequest $request, $id)
    {
        $product = $this->repository->find($id);
        if (!$product) return response()->error('محصول یافت نشد', null, 404);

        return response()->success(new ProductResource($this->repository->update($product, $request->validated())), 'محصول با موفقیت بروزرسانی شد',200);
    }
}
