<?php

namespace App\Services\Discount;

use App\DTO\DiscountResult;
use App\Interface\DiscountRepositoryInterface;
use App\Models\DiscountUsage;
use App\Models\Order;

class DiscountService implements DiscountServiceInterface
{
    public function __construct(
        protected DiscountRepositoryInterface $discounts,
        protected DiscountCalculator $calculator
    ) {}


    public function apply(Order $order, ?string $code = null): DiscountResult
    {
        $subtotal = 0;
        $discountTotal = 0;

        foreach ($order->items as $item) {


            if (!$item->product) {
                continue;
            }

            $lineTotal = ($item->unit_price + $item->options_price) * $item->quantity;


            $discount = $this->discounts
                ->getActiveForProduct($item->product, $order->user)
                ->sortByDesc('value')
                ->first();

            if ($discount) {

                if ($discount->discountable_type === 'App\Models\Product' && $discount->discountable_id === $item->product->id) {
                    $amount = $this->calculator->calculate($lineTotal, $discount);
                    $discountTotal += $amount;
                    $lineTotal -= $amount;
                }
            }

            $subtotal += $lineTotal;
        }


        if ($code) {
            $discountCode = $this->discounts->findValidCode($code);

            if ($discountCode && $discountCode->discount) {
                $orderDiscount = $this->calculator->calculate($subtotal, $discountCode->discount);


                DiscountUsage::create([
                    'discount_id' => $discountCode->discount->id,
                    'discount_code_id' => $discountCode->id,
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'order_subtotal' => $subtotal,
                    'discount_amount' => $orderDiscount,
                    'final_total' => max(0, $subtotal - $orderDiscount),
                    'used_at' => now(),
                ]);

                $discountTotal += $orderDiscount;
            }
        }

        $finalTotal = max(0, $subtotal - $discountTotal);

        return new DiscountResult(
            round($subtotal, 2),
            round($discountTotal, 2),
            round($finalTotal, 2)
        );
    }
}
