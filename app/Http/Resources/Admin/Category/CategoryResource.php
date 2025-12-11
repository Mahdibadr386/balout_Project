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

            'children' => CategoryResource::collection(
                $this->whenLoaded('childrenRecursive')
            ),
        ];
    }
}


