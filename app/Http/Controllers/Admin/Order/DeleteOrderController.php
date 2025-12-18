<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Interface\OrderRepositoryInterface;

class DeleteOrderController extends Controller
{
    public function __invoke(OrderRepositoryInterface $OrderRepository ,$id)
    {
        auth()->user()->hasPermissionTo('order.delete') ?: abort(403);
        $OrderRepository->delete($id);
        return response()->success( 'سفارش با موفقیت حذف شد');
    }
}
