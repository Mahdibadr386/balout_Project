<?php

namespace App\Http\Resources\Admin\Discount;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountCodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'code' => $this->code,
            'user_id' => $this->user_id,
            'used' => $this->usage()->exists(),
        ];
    }
}
