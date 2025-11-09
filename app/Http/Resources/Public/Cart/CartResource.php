<?php

namespace App\Http\Resources\Public\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int)$this->id,
            'user_id' => (int)$this->user_id,
            'status' => $this->status,
            'subtotal' => (float)$this->subtotal,
            'total' => (float)$this->total,
            'items' => CartItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
