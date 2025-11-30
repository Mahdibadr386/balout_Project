<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;
use App\Http\Requests\Admin\Order\StoreOrderRequest;
use App\Http\Resources\Admin\Order\OrderResource;

class StoreOrderController extends Controller
{
    public function __construct(protected OrderRepository $repository) {}

    public function __invoke(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $order = $this->repository->store($data);

        $order->load('items.options', 'user', 'address');

        return response()->success(new OrderResource($order), 'جزئیات سفارش با موفقیت بارگذاری شد', 200);
    }
}
