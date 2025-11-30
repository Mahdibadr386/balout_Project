<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;
use App\Http\Resources\Admin\Order\OrderResource;

class OrderController extends Controller
{
    public function __construct(protected OrderRepository $repository) {}

    public function __invoke($id)
    {
        return response()->success(new OrderResource($this->repository->find($id)), 'جزئیات سفارش با موفقیت بارگذاری شد', 200);
    }
}
