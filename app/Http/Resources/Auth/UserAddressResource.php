<?php

namespace App\Http\Resources\Auth;

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
            'id'       => $this->id,
            'city_id'  => $this->city_id,
            'city_name'=> $this->city->name ?? null,
            'address'  => $this->address,
            'tel'      => $this->tel,
        ];
    }
}
