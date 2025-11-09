<?php

namespace App\Services\Cart;

use App\Models\Product;
use App\Repositories\Public\Cart\CartRepository;
use App\Repositories\Public\Cart\CartItemRepository;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartService
{
    public function __construct(
        protected CartRepository $cartRepo,
        protected CartItemRepository $itemRepo
    ) {}

    public function addProduct(int $userId, array $data): CartItem
    {
        $cart = $this->cartRepo->findCartByUser($userId, true);

        $product = Product::findOrFail($data['product_id']);
        $price = (float) $product->price_base;

        $itemData = [
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => $data['quantity'] ?? 1,
            'price' => $price,
        ];

        return DB::transaction(function () use ($cart, $itemData, $data) {

            $item = $this->itemRepo->createItem($itemData);


            if (!empty($data['options']) && is_array($data['options'])) {
                foreach ($data['options'] as $opt) {
                    $this->itemRepo->addOption($item, $opt);
                }
            }


            if (!empty($data['messages']) && is_array($data['messages'])) {
                foreach ($data['messages'] as $msg) {
                    $this->itemRepo->addOptionMessage($item,$msg);
                }
            }

            $this->itemRepo->calculateTotal($item);
            $this->cartRepo->calculateCartTotal($cart);

            return $item->refresh();
        });
    }




    public function incrementProduct(int $userId, int $itemId, int $by = 1): ?CartItem
    {
        $cart = $this->cartRepo->findCartByUser($userId, false);
        if (! $cart) return null;

        $item = $this->itemRepo->findItemByIdForCart($cart->id, $itemId);
        if (! $item) return null;

        return DB::transaction(function () use ($cart, $item, $by) {
            $updated = $this->itemRepo->incrementQuantity($item, $by);
            $this->cartRepo->calculateCartTotal($cart);
            return $updated;
        });
    }

    public function decrementProduct(int $userId, int $itemId, int $by = 1): ?CartItem
    {
        $cart = $this->cartRepo->findCartByUser($userId, false);
        if (! $cart) return null;

        $item = $this->itemRepo->findItemByIdForCart($cart->id, $itemId);
        if (! $item) return null;

        return DB::transaction(function () use ($cart, $item, $by) {
            $updated = $this->itemRepo->decrementQuantity($item, $by);
            $this->cartRepo->calculateCartTotal($cart);
            return $updated;
        });
    }

    public function removeItem(int $userId, int $item): bool
    {

        $cart = $this->cartRepo->findCartByUser($userId, false);

        if (!$cart) {
            Log::warning("Cart not found for user", ['user_id' => $userId]);
            return false;
        }


        $item = $cart->items()->where('id', $item)->first();

        if (!$item) {
            Log::warning("Cart item not found", ['cart_id' => $cart->id, 'item_id' => $item]);
            return false;
        }

        try {

            $item->options()->delete();

            $item->delete();


            $this->cartRepo->calculateCartTotal($cart);

            return true;
        } catch (\Throwable $e) {
            Log::error("Error deleting cart item", [
                'user_id' => $userId,
                'item_id' => $item,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }


    public function getCart(int $userId)
    {
        return $this->cartRepo->findCartByUser($userId);
    }
}
