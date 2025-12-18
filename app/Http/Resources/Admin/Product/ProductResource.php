<?php

namespace App\Http\Resources\Admin\Product;

use App\Http\Resources\Admin\Option\OptionResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

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
                    'file_name' => $media->file_name,
                    'collection' => $media->collection_name,
                    'url' => $media->getFullUrl(),
                ];
            }),
            'options' => $this->options->map(function ($option) {
                $pivotDetails = $option->pivot ? [$option->pivot->detail_id] : [];

                return [
                    'id' => $option->id,
                    'name' => $option->name,
                    'details' => $option->details()
                        ->whereIn('id', $pivotDetails)
                        ->get()
                        ->map(function ($detail) {
                            return [
                                'id' => $detail->id,
                                'name' => $detail->name,
                            ];
                        }),
                ];
            }),
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s') ?? null,
            'updated_at' => Jalalian::fromCarbon($this->updated_at)->format('Y/m/d H:i:s') ?? null,
        ];
    }
}
