<?php

namespace App\Http\Resources\Admin\Category;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'slug'        => $this->slug,
            'parent_id'   => $this->parent_id,
            'description' => $this->description,
            'is_active'   => (bool) $this->is_active,
            'sort_order'  => (int) $this->sort_order,
            'created_at'  => $this->created_at?->format('Y-m-d H:i'),
            'updated_at'  => $this->updated_at?->format('Y-m-d H:i'),
            'parent' => new CategoryResource($this->whenLoaded('parent')),
        ];
    }
}
