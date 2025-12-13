<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'name_en'       => $this->name_en,
            'tel'           => $this->tel,
            'national_code' => $this->national_code,
            'description'   => $this->description,
            'status'        => $this->status,
            'is_active'     => $this->is_active,
            'birth_date'    => $this->birth_date,
            'marriage_date' => $this->marriage_date,
            'last_login_date' => $this->last_login_date,
            'addresses' => $this->addresses->map(function($address) {
                return [
                    'id' => $address->id,
                    'address' => $address->address,
                    'tel' => $address->tel,
                    'city_id' => $address->city_id,
                ];
            }),
            'created_at'    => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),
        ];
    }


}
