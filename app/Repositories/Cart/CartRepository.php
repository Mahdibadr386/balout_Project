<?php
namespace App\Repositories\Cart;

use App\Models\Cart;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CartRepository implements CartRepositoryInterface
{
    public function findCartByUser(int $userId, bool $createIfNotExist = true): Cart
    {
        $cart = Cart::where('user_id', $userId)
            ->where('status', 'pending')
            ->first();

        if (! $cart && $createIfNotExist) {
            $cart = Cart::create([
                'user_id' => $userId,
                'status' => 'pending',
                'subtotal' => 0,
                'total' => 0,
            ]);
        }

        if (! $cart) {
            throw new ModelNotFoundException("Cart not found for user {$userId}");
        }

        return $cart;
    }


    public function calculateCartTotal(Cart $cart): Cart
    {
        $cart->refresh();

        $subtotal = (float) $cart->items()->selectRaw('SUM(total_price) as s')->value('s') ?: 0.0;

        $cart->subtotal = $subtotal;
        $cart->total = $subtotal;
        $cart->save();

        return $cart;
    }
}
