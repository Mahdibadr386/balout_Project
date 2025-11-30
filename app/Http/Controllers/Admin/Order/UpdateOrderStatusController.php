<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Order\OrderRepository;
use App\Http\Requests\Admin\Order\UpdateOrderStatusRequest;
use App\Http\Resources\Admin\Order\OrderResource;

class UpdateOrderStatusController extends Controller
{
    public function __construct(protected OrderRepository $repository) {}

    public function __invoke(UpdateOrderStatusRequest $request, $id)
    {
        $this->repository->updateStatus($id, $request->status);
        $order = $this->repository->find($id);
        return response()->success(new OrderResource($order), 'اطلاعات سفارش با موفقیت تغییر داده شد', 200);
    }
}
