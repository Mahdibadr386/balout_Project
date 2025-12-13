<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderRepositoryInterface;

class DeleteOrderController extends Controller
{
    public function __invoke(OrderRepositoryInterface $OrderRepository ,$id)
    {
        $OrderRepository->delete($id);
        return response()->success( 'سفارش با موفقیت حذف شد');
    }
}
