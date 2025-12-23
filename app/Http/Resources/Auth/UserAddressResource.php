<?php

namespace App\Http\Resources\Auth;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'city_name'=> optional(City::find($this->city_id))->name_fa ?? null,
            'district' =>optional(District::find($this->district_id))->name_fa ?? null,
            'address'  => $this->address,
            'tel'      => $this->tel,
        ];
    }
}
