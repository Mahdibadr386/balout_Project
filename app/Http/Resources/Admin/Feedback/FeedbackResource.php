<?php

namespace App\Http\Resources\Admin\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product' => [
                'id' => $this->product->id,
                'name' => $this->product->name,
            ],
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'comment' => $this->comment,
            'rate' => $this->rate,
            'approved' => $this->approved,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
