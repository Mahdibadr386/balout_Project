<?php

namespace App\Http\Resources\Public\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (int) $this->id,
            'name' => $this->name,
            'price' => (float) $this->price,
        ];
    }
}
