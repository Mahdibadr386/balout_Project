<?php

namespace App\Http\Resources\Public\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class FeedbackResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'user_id'    => $this->user_id,
            'comment'    => $this->comment,
            'rate'       => $this->rate,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),
        ];
    }
}
