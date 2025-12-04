<?php

namespace App\Http\Resources\Admin\Option;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'type' => $this->type,
            'name' => $this->name,
            'effect' => $this->effect,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'option_details'  => OptionDetailResource::collection(
                $this->whenLoaded('details')
            ),
        ];
    }
}
