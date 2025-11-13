<?php

namespace App\Repositories\Public\Order;

use App\Models\OrderItem;

class OrderItemRepository
{
    public function create(array $data): OrderItem
    {
        return OrderItem::create($data);
    }
}
