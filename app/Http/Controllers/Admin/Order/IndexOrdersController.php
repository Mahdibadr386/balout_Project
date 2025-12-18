<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Order\OrderResource;
use App\Interface\OrderRepositoryInterface;
use Illuminate\Http\Request;

class IndexOrdersController extends Controller
{
    public function __invoke(Request $request,OrderRepositoryInterface $OrderRepository)
    {
        auth()->user()->hasPermissionTo('order.index') ?: abort(403);

        $filters = $request->only([
            'search',
        ]);

        return response()->success( 'لیست سفارش‌ها با موفقیت بارگذاری شد',OrderResource::collection($OrderRepository->paginate($filters)));
    }
}
