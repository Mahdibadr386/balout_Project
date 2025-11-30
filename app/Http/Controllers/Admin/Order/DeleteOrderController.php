<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;

class DeleteOrderController extends Controller
{
    public function __construct(protected OrderRepository $repository) {}

    public function __invoke($id)
    {
        $this->repository->delete($id);
        return response()->success(null, 'سفارش با موفقیت حذف شد', 200);
    }
}
