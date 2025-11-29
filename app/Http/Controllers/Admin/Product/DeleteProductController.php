<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Product\ProductRepository;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
    public function __construct(protected ProductRepository $repository) {}

    public function __invoke($id)
    {
        $product = $this->repository->find($id);
        if (!$product) return response()->error('محصول یافت نشد', null, 404);

        $this->repository->delete($product);
        return response()->success(null, 'محصول با موفقیت حذف شد',200);
    }
}
