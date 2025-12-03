<?php

namespace App\Http\Resources\Public\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedbackResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'product_id' => $this->product_id,
            'user_id'    => $this->user_id,
            'comment'    => $this->comment,
            'rate'       => $this->rate,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
