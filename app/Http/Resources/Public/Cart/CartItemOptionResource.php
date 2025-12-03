<?php

namespace App\Http\Resources\Public\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemOptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'option_name' => optional($this->option)->name,
            'option_detail' => $this->whenLoaded('optionDetail')
                ? new OptionDetailResource($this->optionDetail)
                : null,
            'price_effect' => $this->when($this->optionDetail !== null, fn() => (float) $this->price_effect),
            'option_messages' => $this->whenLoaded('optionMessage')
                ? new OptionMessageResource($this->optionMessage)
                : null,
        ];
    }
}
