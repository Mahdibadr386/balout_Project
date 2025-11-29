<?php

namespace App\Repositories\Public\Product;

use App\Models\Category;
use App\Models\Product;

class ProductRepository
{
    public function categoryProducts(string $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return null;
        }

        // Get available products of this Category
        return Product::with('Category')
            ->where('category_id', $category->id)
            ->where('available', true)
            ->get();
    }

    public function products()
    {
        $products = Product::with('Category')->where('available', true)->paginate(10);
        return $products;
    }

    public function product(string $slug)
    {
        $product = Product::with('Category')->where('slug', $slug)->where('available', true)->first();

        if (!$product) {
            return null;
        }

        return $product;
    }
}
