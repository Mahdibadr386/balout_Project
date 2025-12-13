<?php

namespace App\Http\Resources\Admin\Option;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class OptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'type' => $this->type,
            'name' => $this->name,
            'effect' => $this->effect,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),
            'option_details'  => OptionDetailResource::collection(
                $this->whenLoaded('details')
            ),
        ];
    }
}
