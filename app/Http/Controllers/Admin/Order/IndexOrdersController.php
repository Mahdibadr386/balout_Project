<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;
use App\Http\Resources\Admin\Order\OrderResource;

class IndexOrdersController extends Controller
{
    public function __invoke(OrderRepository $OrderRepository)
    {
        return response()->success(OrderResource::collection($OrderRepository->paginate()), 'لیست سفارش‌ها با موفقیت بارگذاری شد', 200);
    }
}
