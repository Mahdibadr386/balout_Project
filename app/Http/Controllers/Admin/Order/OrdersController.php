<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;
use App\Http\Resources\Admin\Order\OrderResource;

class OrdersController extends Controller
{
    public function __construct(protected OrderRepository $repository) {}

    public function __invoke()
    {
        return response()->success(OrderResource::collection($this->repository->paginate()), 'لیست سفارش‌ها با موفقیت بارگذاری شد', 200);
    }
}
