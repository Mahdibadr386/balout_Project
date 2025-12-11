<?php

namespace App\Http\Resources\Admin\Permission;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'roles'  => $this->roles->pluck('id'),
        ];
    }
}
