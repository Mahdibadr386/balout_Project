<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;

class DeleteOrderController extends Controller
{
    public function __invoke(OrderRepository $OrderRepository ,$id)
    {
        $OrderRepository->delete($id);
        return response()->success( 'سفارش با موفقیت حذف شد');
    }
}
