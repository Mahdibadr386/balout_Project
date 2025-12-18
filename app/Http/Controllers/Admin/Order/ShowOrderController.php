<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Order\OrderResource;
use App\Interface\OrderRepositoryInterface;

class ShowOrderController extends Controller
{
    public function __invoke(OrderRepositoryInterface $OrderRepository,$id)
    {
        auth()->user()->hasPermissionTo('order.show') ?: abort(403);
        return response()->success( ' سفارش با موفقیت بارگذاری شد',new OrderResource($OrderRepository->find($id)));
    }
}
