<?php
namespace App\Services;

use App\Models\Product;
use Exception;

class StockService
{

    public function reserveAndDecrease(Product $product, int $qty): void
    {
        if ($product->quantity < $qty) {
            throw new Exception("{$product->name}مقدار کافی برای محصول وجود ندارد: ");
        }

        $product->decrement('quantity', $qty);
        $product->refresh();
    }
}
