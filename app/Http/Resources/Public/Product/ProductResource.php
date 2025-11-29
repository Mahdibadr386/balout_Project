<?php

namespace App\Http\Resources\Public\Product;

use App\Http\Resources\Public\Feedback\FeedbackResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price_base' => (float) $this->price_base,
            'discount_percentage' => $this->discount_percentage,
            'unit' => $this->unit,
            'quantity' => $this->quantity,
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
            'preparation_time' => $this->preparation_time,
            'available' => $this->available,
            'rate' => (float) $this->rate,
            'batch_code' => $this->batch_code,
            'matin_code' => $this->matin_code,
            'Category' => $this->whenLoaded('Category', function () {
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                    'slug' => $this->category->slug,
                ];
            }),
            'feedbacks'     => FeedbackResource::collection($this->whenLoaded('feedbacks')),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}
