<?php

namespace App\Repositories\Public\Order;

use App\Models\OrderItemOption;

class OrderItemOptionRepository
{
    public function create(array $data): OrderItemOption
    {
        return OrderItemOption::create($data);
    }
}
