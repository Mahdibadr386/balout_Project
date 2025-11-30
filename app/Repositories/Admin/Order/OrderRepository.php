<?php

namespace App\Repositories\Admin\Order;

use App\Models\Option;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderRepository
{
    public function paginate()
    {
        return Order::with('items.options')->latest()->paginate(20);
    }

    public function find($id)
    {
        return Order::with('items.options')->findOrFail($id);
    }

    public function store(array $data): Order
    {
        $user = User::findOrFail($data['user_id']);
        $product = Product::findOrFail($data['product_id']);

        return DB::transaction(function () use ($data, $user, $product) {

            $order = Order::create([
                'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . Str::random(6),
                'user_id' => $user->id,
                'address_id' => $data['address_id'],
                'status' => 'pending',
                'subtotal' => $product->price_base * ($data['quantity'] ?? 1),
                'discount' => 0,
                'shipping_cost' => $data['shipping_cost'] ?? 0,
                'tax' => $data['tax'] ?? 0,
                'total' => ($product->price_base * ($data['quantity'] ?? 1)) + ($data['options_price'] ?? 0),
                'payment_method' => $data['payment_method'],
                'currency' => 'IRR',
                'meta' => [
                    'address_snapshot' => $user->addresses()->find($data['address_id'])->toArray(),
                    'shipping_method' => $data['shipping_method'] ?? null,
                ],
            ]);

            $orderItem = $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $data['quantity'] ?? 1,
                'unit_price' => $product->price_base,
                'options_price' => $this->calculateOptionsPrice($data['options'] ?? []),
                'total_price' => ($product->price_base * ($data['quantity'] ?? 1)) + ($this->calculateOptionsPrice($data['options'] ?? [])),
                'product_snapshot' => $product->only(['id', 'name', 'slug']),
            ]);


            if (!empty($data['options'])) {
                foreach ($data['options'] as $opt) {
                    $orderItem->options()->create([
                        'option_id' => $opt['option_id'] ?? null,
                        'option_detail_id' => $opt['option_detail_id'] ?? null,
                        'option_name' => Option::find($opt['option_id'])->name ?? null,
                        'option_detail_name' => OptionDetail::find($opt['option_detail_id'])->name ?? null,
                        'message' => null,
                        'price_effect' => $opt['price_effect'] ?? 0,
                    ]);
                }
            }


            if (!empty($data['messages'])) {
                foreach ($data['messages'] as $msg) {
                    $orderItem->options()->create([
                        'option_id' => $msg['option_id'] ?? null,
                        'option_detail_id' => null,
                        'option_name' => Option::find($msg['option_id'])->name ?? null,
                        'option_detail_name' => null,
                        'message' => $msg['message'] ?? null,
                        'price_effect' => 0,
                    ]);
                }
            }

            return $order;
        });
    }

    private function calculateOptionsPrice(array $options): float
    {
        return collect($options)->sum(fn($opt) => $opt['price_effect'] ?? 0);
    }

    public function delete($id)
    {
        $order = $this->find($id);
        return $order->delete();
    }

    public function updateStatus($id, $status)
    {
        $order = $this->find($id);
        $order->update(['status' => $status]);
        return $order;
    }


}
