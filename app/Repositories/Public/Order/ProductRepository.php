<?php

namespace App\Repositories\Public\Order;

use App\Models\Product;

class ProductRepository
{
    public function lockAndFind(int $id): ?Product
    {
        return Product::where('id', $id)->lockForUpdate()->first();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function decrementStock(Product $product, int $quantity): void
    {
        $product->decrement('stock', $quantity);
    }

    public function incrementStock(Product $product, int $quantity): void
    {
        $product->increment('stock', $quantity);
    }
}
