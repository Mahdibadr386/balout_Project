<?php

namespace App\Interface\Cart;

use App\Models\Cart;

interface CartRepositoryInterface
{
    /** Find the cart for a user, optionally creating one if it doesn't exist */
    public function findCartByUser(int $userId, bool $createIfNotExist = true): Cart;

    /** Calculate and update the subtotal and total of the given cart */
    public function calculateCartTotal(Cart $cart): Cart;
}
