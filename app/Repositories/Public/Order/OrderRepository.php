<?php

namespace App\Repositories\Public\Order;

use App\Models\Order;

class OrderRepository
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function findWithItems(int $id): ?Order
    {
        return Order::with(['items.options','payments'])->find($id);
    }

    public function updateStatus(Order $order, string $status): bool
    {
        $order->status = $status;
        return $order->save();
    }
}
