<?php

namespace App\Services\Discount;

use App\Models\Discount;

class DiscountCalculator
{
    public function calculate(float $base, Discount $discount): float
    {
        $amount = $discount->type === 'percent'
            ? $base * ($discount->value / 100)
            : $discount->value;

        if ($discount->max_amount) {
            $amount = min($amount, $discount->max_amount);
        }

        return round($amount, 2);
    }
}

