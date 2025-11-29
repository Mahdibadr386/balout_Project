<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price_base' => $this->price_base,
            'discount_percentage' => $this->discount_percentage,
            'unit' => $this->unit,
            'quantity' => $this->quantity,
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
            'preparation_time' => $this->preparation_time,
            'available' => $this->available,
            'rate' => $this->rate,
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->name,
            ] : null,
            'media' => $this->media->map(function ($media) {
                return [
                    'id' => $media->id,
                    'type' => $media->type,
                    'collection_name' => $media->collection_name,
                    'file_name' => $media->file_name,
                    'url' => $media->url,
                    'order_column' => $media->order_column,
                    'custom_properties' => $media->custom_properties,
                    'duration' => $media->duration,
                ];
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
