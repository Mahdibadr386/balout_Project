<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;
use App\Http\Resources\Admin\Order\OrderResource;

class ShowOrderController extends Controller
{
    public function __invoke(OrderRepository $OrderRepository,$id)
    {
        return response()->success( ' سفارش با موفقیت بارگذاری شد',new OrderResource($OrderRepository->find($id)));
    }
}
