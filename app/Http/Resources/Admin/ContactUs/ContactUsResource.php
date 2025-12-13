<?php

namespace App\Http\Resources\Admin\ContactUs;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class ContactUsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'tel'        => $this->tel,
            'subject'    => $this->subject,
            'message'    => $this->message,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),

        ];
    }
}
