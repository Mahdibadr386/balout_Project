<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Public\Feedback\FeedbackResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
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
            'birth_date'    => $this->birth_date,
            'marriage_date' => $this->marriage_date,
            'status'        => $this->status,
            'is_active'     => $this->is_active,
            'created_at'    => $this->created_at?->format('Y-m-d H:i:s'),
            'addresses'     => UserAddressResource::collection($this->whenLoaded('addresses')),
            'feedbacks'     => FeedbackResource::collection($this->whenLoaded('feedbacks')),
        ];
    }
}
