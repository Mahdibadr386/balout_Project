<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'is_new_user' => $this['is_new_user'] ?? null,
            'token'       => $this['token'] ?? null,
            'token_type'  => 'Bearer',
            'expires_in'  => $this['expires_in'] ?? 604800,
        ];
    }
}
