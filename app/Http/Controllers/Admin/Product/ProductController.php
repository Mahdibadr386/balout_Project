<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Repositories\Admin\Product\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $repository) {}

    public function __invoke($id)
    {
        $product = $this->repository->find($id);
        if ($product) {
            $product->load('media');
        }

        return $product
            ? response()->success(new ProductResource($product) , 'محصول یافت شد' , 200)
            : response()->error('محصول یافت نشد', null, 404);
    }
}
