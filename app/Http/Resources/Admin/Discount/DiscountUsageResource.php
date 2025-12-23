<?php

namespace App\Http\Resources\Admin\Discount;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountUsageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->order_id,
            'discount' => $this->discount->name,
            'code' => $this->code->code,
            'discount_amount' => $this->discount_amount,
            'final_total' => $this->final_total,
            'user_id' => $this->user_id,
            'used_at' => $this->used_at,
        ];
    }
}
