<?php

namespace App\Repositories\Cart;

use App\Models\CartItem;
use App\Models\CartItemOption;
use App\Models\OptionMessage;

interface CartItemRepositoryInterface
{
    /** Create a new cart item */
    public function createItem(array $data): CartItem;

    /** Add an option to a cart item */
    public function addOption(CartItem $item, array $opt): CartItemOption;

    /** Add a message for an option on a cart item */
    public function addOptionMessage(CartItem $item, array $msg): OptionMessage;

    /** Calculate and update the total price of the cart item */
    public function calculateTotal(CartItem $item): CartItem;

    /** Find a cart item by its ID for a specific cart */
    public function findItemByIdForCart(int $cartId, int $itemId): ?CartItem;

    /** Increment the quantity of a cart item and recalculate total */
    public function incrementQuantity(CartItem $item, int $by = 1): CartItem;

    /** Decrement the quantity of a cart item and recalculate total */
    public function decrementQuantity(CartItem $item, int $by = 1): CartItem;
}
