<?php

namespace App\Http\Resources\Admin\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class OrderResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'address_id' => $this->address_id,
            'subtotal' => $this->subtotal,
            'discount' => $this->discount,
            'shipping_cost' => $this->shipping_cost,
            'tax' => $this->tax,
            'total' => $this->total,
            'payment_method' => $this->payment_method,
            'currency' => $this->currency,
            'meta' => $this->meta,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),
            'updated_at' => Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i:s'),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
