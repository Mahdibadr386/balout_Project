<?php

namespace App\Services;

use App\Interface\OrderRepositoryInterface;
use App\Interface\PaymentTransactionRepositoryInterface;
use App\Interface\ProductRepositoryInterface;
use App\Models\Option;
use App\Models\OptionDetail;
use App\Services\Discount\DiscountServiceInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CheckoutService
{
    public function __construct(
        protected OrderRepositoryInterface $orders,
        protected PaymentTransactionRepositoryInterface $transactions,
        protected ProductRepositoryInterface $products,
        protected StockService $stock,
        protected DiscountServiceInterface $discounts
    ) {}

    public function createOrderFromCart($user, $cart, array $data): array
    {
        return DB::transaction(function () use ($user, $cart, $data) {

            $cart->load('items.options');

            if ($cart->items->isEmpty()) {
                throw new Exception('سبد خالی است');
            }

            $meta = [
                'shipping_method' => $data['shipping_method'] ?? null,
            ];

            if (!empty($data['address_id'])) {
                $address = $user->addresses()
                    ->where('id', $data['address_id'])
                    ->first();

                if (!$address) {
                    throw new Exception('آدرس انتخاب‌شده معتبر نیست');
                }

                $meta['address_snapshot'] = $address->toArray();
            }

            if (!empty($data['address_id'])) {
                $shipping = 100000;
            }


            $order = $this->orders->OrderCreate([
                'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . Str::random(6),
                'user_id' => $user->id,
                'address_id' => $data['address_id'] ?? null,
                'branch_id' => $data['branch_id'] ?? null,
                'send_date' => $data['send_date'] ?? null,
                'send_hour' => $data['send_hour'] ?? null,
                'status' => 'pending',
                'subtotal' => 0,
                'discount' => 0,
                'shipping_cost' => $shipping ?? 0,
                'tax' => $cart->tax ?? 0,
                'total' => 0,
                'payment_method' => $data['payment_method'],
                'currency' => 'IRR',
                'meta' => $meta,
                'expires_at' => Carbon::now()->addHour(),
            ]);


            foreach ($cart->items as $cartItem) {

                $product = $this->products->lockAndFind($cartItem->product_id);
                if (!$product) {
                    throw new Exception("محصول یافت نشد: {$cartItem->product_id}");
                }

                $this->stock->reserveAndDecrease($product, $cartItem->quantity);

                $orderItem = $this->orders->OrderItemCreate([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $product->price_base,
                    'options_price' => $cartItem->options_price ?? 0,
                    'total_price' => 0,
                    'product_snapshot' => $product->only(['id','name','slug']),
                ]);

                foreach ($cartItem->options as $opt) {
                    $this->orders->OrderItemOptionCreate([
                        'order_item_id' => $orderItem->id,
                        'option_id' => $opt->option_id ?? null,
                        'option_detail_id' => $opt->option_detail_id ?? null,
                        'option_name' => Option::find($opt->option_id)->name ?? null,
                        'option_detail_name' => OptionDetail::find($opt->option_detail_id)->name ?? null,
                        'message' => $opt->option_message_id ?? null,
                        'price_effect' => $opt->price_effect ?? 0,
                    ]);
                }
            }

            $order->load('items.options', 'user');

            $result = $this->discounts->apply(
                $order,
                $data['discount_code'] ?? null
            );


            $order->update([
                'subtotal' => $result->subtotal,
                'discount' => $result->discount,
                'total' => $result->total + $order->shipping_cost + $order->tax,
            ]);


            $payment = $this->transactions->create([
                'order_id' => $order->id,
                'gateway' => $data['payment_method'],
                'gateway_transaction_id' => null,
                'amount' => $order->total,
                'status' => 'initiated',
                'currency' => 'IRR',
                'idempotency_key' => $data['idempotency_key'] ?? Str::uuid(),
                'request_payload' => null,
            ]);



            return [
                'order' => $order->fresh(),
                'payment' => $payment,
            ];
        });
    }
}
