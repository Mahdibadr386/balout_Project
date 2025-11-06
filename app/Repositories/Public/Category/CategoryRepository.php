<?php

namespace App\Repositories\Public\Category;

use App\Models\Category;

class CategoryRepository
{
    public function all()
    {
        $categories = Category::with('children')
            ->whereNull('parent_id')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        return $categories;
    }

}
