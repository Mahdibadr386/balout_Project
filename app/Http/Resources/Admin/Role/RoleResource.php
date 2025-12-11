<?php

namespace App\Http\Resources\Admin\Role;

use App\Http\Resources\Admin\Permission\PermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'permissions' => PermissionResource::collection($this->permissions),
            'users' => $this->users->pluck('id'),
        ];
    }
}
