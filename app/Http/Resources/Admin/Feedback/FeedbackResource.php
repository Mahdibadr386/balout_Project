<?php

namespace App\Http\Resources\Admin\Feedback;

use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

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
            ],
            'comment' => $this->comment,
            'rate' => $this->rate,
            'approved' => $this->approved,
            'created_at' => Jalalian::fromCarbon($this->created_at)->format('Y/m/d H:i:s'),
        ];
    }
}
