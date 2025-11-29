<?php

namespace App\Http\Resources\Admin\Option;

use Illuminate\Http\Resources\Json\JsonResource;

class OptionDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'option_id' => $this->option_id,
            'name'      => $this->name,
            'price'     => $this->price,
            'created_at'=> $this->created_at?->format('Y-m-d H:i'),
            'updated_at'=> $this->updated_at?->format('Y-m-d H:i'),
        ];
    }
}
