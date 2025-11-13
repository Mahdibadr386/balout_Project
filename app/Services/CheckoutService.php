<?php
namespace App\Services;

use App\Models\Option;
use App\Models\OptionDetail;
use App\Repositories\Public\Order\{OrderRepository,OrderItemRepository,OrderItemOptionRepository,PaymentTransactionRepository,ProductRepository};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;

class CheckoutService
{
    public function __construct(
        protected OrderRepository $orders,
        protected OrderItemRepository $orderItems,
        protected OrderItemOptionRepository $orderItemOptions,
        protected PaymentTransactionRepository $transactions,
        protected ProductRepository $products,
        protected StockService $stock
    ) {}


    public function createOrderFromCart($user, $cart, array $data): array
    {
        return DB::transaction(function () use ($user, $cart, $data) {

            $cart->load('items.options');

            if ($cart->items->isEmpty()) {
                throw new Exception('سبد خالی است');
            }


            $order = $this->orders->create([
                'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . Str::random(6),
                'user_id' => $user->id,
                'address_id' => $data['address_id'],
                'status' => 'pending',
                'subtotal' => $cart->subtotal,
                'discount' => $cart->discount ?? 0,
                'shipping_cost' => $cart->shipping_cost ?? 0,
                'tax' => $cart->tax ?? 0,
                'total' => $cart->total,
                'payment_method' => $data['payment_method'],
                'currency' => 'IRR',
                'meta' => [
                    'address_snapshot' => $user->addresses()->find($data['address_id'])->toArray(),
                    'shipping_method' => $data['shipping_method'] ?? null,
                ],
            ]);


            foreach ($cart->items as $cartItem) {

                $product = $this->products->lockAndFind($cartItem->product_id);
                if (!$product) throw new Exception("{$cartItem->product_id}محصول یافت نشد: ");


                $this->stock->reserveAndDecrease($product, $cartItem->quantity);

                $orderItem = $this->orderItems->create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'unit_price' => $cartItem->price,
                    'options_price' => $cartItem->options_price ?? 0,
                    'total_price' => ($cartItem->price + ($cartItem->options_price ?? 0)) * $cartItem->quantity,
                    'product_snapshot' => $product->only(['id','name','slug']),
                ]);


                foreach ($cartItem->options as $opt) {
                    $this->orderItemOptions->create([
                        'order_item_id' => $orderItem->id,
                        'option_id' => $opt->option_id ?? null,
                        'option_detail_id' => $opt->option_detail_id ?? null,
                        'option_name' => Option::find($opt->option_id)->name ?? null,
                        'option_detail_name' => (OptionDetail::find($opt->option_detail_id))->name ?? null,
                        'message' => $opt->option_message_id ?? null,
                        'price_effect' => $opt->price_effect ?? 0,
                    ]);
                }
            }


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

            return ['order' => $order, 'payment' => $payment];
        });
    }
}
