<?php

namespace App\Http\Resources\Public\Time;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TimeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hour =  ('ساعت '. $this->start . ' - '  .$this->end);
        return [
            'id'    => $this->id,
            'time'    => $hour,
        ];
    }
}
