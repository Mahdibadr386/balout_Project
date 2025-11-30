<?php

namespace App\Http\Resources\Admin\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'options_price' => $this->options_price,
            'total_price' => $this->total_price,
            'product_snapshot' => $this->product_snapshot,
            'options' => OrderItemOptionResource::collection($this->whenLoaded('options')),
        ];
    }
}
