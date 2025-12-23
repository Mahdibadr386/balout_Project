<?php

namespace App\Services\Discount;

use App\DTO\DiscountResult;
use App\Models\Order;

interface DiscountServiceInterface
{
    /**
     * Apply eligible product and optional discount code reductions to an order and return final pricing result.
     */
    public function apply(Order $order, ?string $code = null): DiscountResult;
}

