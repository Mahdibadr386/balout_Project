<?php

namespace App\Http\Resources\Admin\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemOptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'option_id' => $this->option_id,
            'option_detail_id' => $this->option_detail_id,
            'option_name' => $this->option_name,
            'option_detail_name' => $this->option_detail_name,
            'message' => $this->message,
            'price_effect' => $this->price_effect,
        ];
    }
}
