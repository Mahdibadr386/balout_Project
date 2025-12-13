<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Order\OrderResource;
use App\Repositories\Order\OrderRepositoryInterface;

class ShowOrderController extends Controller
{
    public function __invoke(OrderRepositoryInterface $OrderRepository,$id)
    {
        return response()->success( ' سفارش با موفقیت بارگذاری شد',new OrderResource($OrderRepository->find($id)));
    }
}
