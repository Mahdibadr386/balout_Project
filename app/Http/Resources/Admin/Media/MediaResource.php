<?php

namespace App\Http\Resources\Admin\Media;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'type' => $this->type,
            'collection' => $this->collection_name,
            'url' => $this->url,
            'size' => $this->size,
            'duration' => $this->duration,
            'alt'  => $this->alt,
            'order' => $this->order_column,
        ];
    }
}
