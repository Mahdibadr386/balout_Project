<?php

namespace App\Http\Resources\Public\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'user_id' => (int)$this->user_id,
            'status' => $this->status,
            'subtotal' => (float)$this->subtotal,
            'total' => (float)$this->total,
            'items' => CartItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
