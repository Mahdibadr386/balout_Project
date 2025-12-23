<?php

namespace App\DTO;

class DiscountResult
{
    public function __construct(
        public float $subtotal,
        public float $discount,
        public float $total
    ) {}
}

