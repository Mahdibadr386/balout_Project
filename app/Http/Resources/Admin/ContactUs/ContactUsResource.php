<?php

namespace App\Http\Resources\Admin\ContactUs;

use Illuminate\Http\Resources\Json\JsonResource;

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
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
