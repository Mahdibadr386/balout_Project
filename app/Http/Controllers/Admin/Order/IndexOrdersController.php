<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Order\OrderResource;
use App\Repositories\Order\OrderRepositoryInterface;

class IndexOrdersController extends Controller
{
    public function __invoke(OrderRepositoryInterface $OrderRepository)
    {
        return response()->success( 'لیست سفارش‌ها با موفقیت بارگذاری شد',OrderResource::collection($OrderRepository->paginate()));
    }
}
