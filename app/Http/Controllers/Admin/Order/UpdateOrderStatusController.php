<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\UpdateOrderStatusRequest;
use App\Http\Resources\Admin\Order\OrderResource;
use App\Repositories\Order\OrderRepositoryInterface;

class UpdateOrderStatusController extends Controller
{
    public function __invoke(OrderRepositoryInterface $OrderRepository,UpdateOrderStatusRequest $request, $id)
    {
        $OrderRepository->updateStatus($id, $request->status);
        $order = $OrderRepository->find($id);
        return response()->success( 'اطلاعات سفارش با موفقیت تغییر داده شد',new OrderResource($order));
    }
}
