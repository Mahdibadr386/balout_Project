<?php

namespace App\Http\Resources\Admin\Discount;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'scope' => $this->scope,
            'type' => $this->type,
            'value' => $this->value,
            'max_amount' => $this->max_amount,
            'is_personal' => $this->is_personal,
            'is_active' => $this->is_active,
            'discountable_type' => $this->discountable_type,
            'discountable_id' => $this->discountable_id,
            'starts_at' => optional($this->starts_at)->toDateTimeString(),
            'ends_at' => optional($this->ends_at)->toDateTimeString(),
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),


            'codes_count' => $this->whenLoaded('codes', $this->codes->count()),
            'codes' => DiscountCodeResource::collection($this->whenLoaded('codes')),


            'usages' => DiscountUsageResource::collection($this->whenLoaded('usages')),
        ];
    }
}
