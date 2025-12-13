<?php

namespace App\Http\Resources\Admin\Option;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class OptionDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'option_id' => $this->option_id,
            'name'      => $this->name,
            'price'     => $this->price,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),
        ];
    }
}
