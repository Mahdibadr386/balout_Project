<?php

namespace App\Http\Resources\Public\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionMessageResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'text' => $this->text,
        ];
    }
}
