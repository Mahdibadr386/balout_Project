<?php

namespace App\Repositories\Mysql;

use App\Interface\OrderRepositoryInterface;
use App\Models\Option;
use App\Models\OptionDetail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemOption;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderRepository implements OrderRepositoryInterface
{
    public function paginate(array $filters = [])
    {
        //delete expired orders
        Order::where('status', 'pending')
            ->where('expires_at', '<', Carbon::now())
            ->delete();


        $perPage = $filters['per_page'] ?? 20;

        if (!empty($filters['search'])) {

            $ids = Order::search($filters['search'])->keys();

            if ($ids->isEmpty()) {
                return Order::whereRaw('1 = 0')->paginate($perPage);
            }

            return Order::with('items.options')
                ->whereIn('id', $ids)
                ->latest()
                ->paginate($perPage);
        }

        return Order::with('items.options')
            ->latest()
            ->paginate($perPage);
    }


    public function find($id)
    {
        //delete expired orders
        Order::where('status', 'pending')
            ->where('expires_at', '<', Carbon::now())
            ->delete();
        return Order::with('items.options')->findOrFail($id);
    }

    public function store(array $data): Order
    {
        $user = User::findOrFail($data['user_id']);
        $product = Product::findOrFail($data['product_id']);

        return DB::transaction(function () use ($data, $user, $product) {

            $meta = [
                'shipping_method' => $data['shipping_method'] ?? null,
            ];

            if (!empty($data['address_id'])) {
                $meta['address_snapshot'] = $user->addresses()->find($data['address_id'])->toArray();
            }

            $order = Order::create([
                'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . Str::random(6),
                'user_id' => $user->id,
                'branch_id' => $data['branch_id'] ?? null,
                'address_id' => $data['address_id'] ?? null,
                'status' => 'shipped',
                'send_date' => $data['send_date'] ?? null,
                'send_hour' => $data['send_hour'] ?? null,
                'subtotal' => $product->price_base * ($data['quantity'] ?? 1),
                'discount' => 0,
                'shipping_cost' => $data['shipping_cost'] ?? 0,
                'tax' => $data['tax'] ?? 0,
                'total' => ($product->price_base * ($data['quantity'] ?? 1)) + ($data['options_price'] ?? 0),
                'payment_method' => $data['payment_method'],
                'currency' => 'IRR',
                'meta' => $meta,
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

        return DB::transaction(function () use ($order) {
            foreach ($order->items as $item) {
                $item->options()->delete();
            }
            $order->items()->delete();

            return $order->delete();
        });
    }



    public function updateStatus($id, $status)
    {
        $order = $this->find($id);
        $order->update(['status' => $status]);
        return $order;
    }



    public function OrderItemOptionCreate(array $data): OrderItemOption
    {
        return OrderItemOption::create($data);
    }


    public function OrderItemCreate(array $data): OrderItem
    {
        return OrderItem::create($data);
    }


    public function OrderCreate(array $data): Order
    {
        return Order::create($data);
    }

    public function OrderFindWithItems(int $id): ?Order
    {
        return Order::with(['items.options','payments'])->find($id);
    }

    public function OrderUpdateStatus(Order $order, string $status): bool
    {
        $order->status = $status;
        return $order->save();
    }

    public function findWithItemsForPricing(int $orderId): Order
    {
        return Order::with(['items.options'])->findOrFail($orderId);
    }

    public function updateTotals(Order $order, float $subtotal, float $discount, float $total): void
    {
        $order->update([
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total'    => $total,
        ]);
    }


}
