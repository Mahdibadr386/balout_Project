<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\StoreOrderRequest;
use App\Http\Resources\Admin\Order\OrderResource;
use App\Interface\OrderRepositoryInterface;

class StoreOrderController extends Controller
{
    public function __invoke(OrderRepositoryInterface $OrderRepository ,StoreOrderRequest $request)
    {
        auth()->user()->hasPermissionTo('order.store') ?: abort(403);
        $data = $request->validated();

        $order = $OrderRepository->store($data);

        $order->load('items.options', 'user', 'address');

        return response()->success( ' سفارش با موفقیت افزوده شد' , new OrderResource($order) , 201);
    }
}
