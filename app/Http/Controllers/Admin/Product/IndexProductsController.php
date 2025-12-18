<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Product\ProductResource;
use App\Interface\ProductRepositoryInterface;
use Illuminate\Http\Request;

class IndexProductsController extends Controller
{
    public function __invoke( Request $request ,ProductRepositoryInterface $ProductRepository)
    {
        auth()->user()->hasPermissionTo('product.index') ?: abort(403);

        $filters = $request->only([
            'search',
        ]);
        return response()->success( 'لیست محصولات با موفقیت دریافت شد' , ProductResource::collection($ProductRepository->all($filters)));
    }
}
