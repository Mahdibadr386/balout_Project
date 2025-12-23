<?php

namespace App\Http\Resources\Public\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product' => [
                'id' => (int)$this->product->id,
                'name' => $this->product->name,
                'slug' => $this->product->slug,
            ],
            'quantity' => (int)$this->quantity,
            'unit_price' => (float)$this->price,
            'options' => CartItemOptionResource::collection($this->whenLoaded('options')),
            'total_price' => (float)$this->total_price,
        ];
    }
}
