<?php
namespace App\Repositories\Mysql\Cart;

use App\Interface\Cart\CartItemRepositoryInterface;
use App\Models\CartItem;
use App\Models\CartItemOption;
use App\Models\Option;
use App\Models\OptionDetail;
use App\Models\OptionMessage;


class CartItemRepository implements CartItemRepositoryInterface
{
    public function createItem(array $data): CartItem
    {
        return CartItem::create($data);
    }

    public function addOption(CartItem $item, array $opt): CartItemOption
    {

        $detail = OptionDetail::find($opt['option_detail_id']);
        $priceEffect = $detail ? (float)$detail->price : 0.0;

        $cio = CartItemOption::create([
            'cart_item_id' => $item->id,
            'option_id' => $opt['option_id'],
            'option_detail_id' => $opt['option_detail_id'],
            'price_effect' => $priceEffect,
        ]);

        return $cio;
    }

    public function addOptionMessage(CartItem $item, array $msg): OptionMessage
    {
        $option = Option::findOrFail($msg['option_id']);
        $text = mb_substr($msg['message'], 0, 255);

        $message = OptionMessage::create([
            'option_id' => $option->id,
            'text'      => $text,
        ]);

        CartItemOption::create([
            'cart_item_id'      => $item->id,
            'option_id'         => $option->id,
            'option_message_id' => $message->id,
        ]);

        return $message;
    }




    public function calculateTotal(CartItem $item): CartItem
    {

        $item->load('options.optionDetail');

        $optionEffect = (float) $item->options()->sum('price_effect');
        $item->total_price = ($item->price + $optionEffect) * $item->quantity;
        $item->save();

        return $item;
    }

    public function findItemByIdForCart(int $cartId, int $itemId): ?CartItem
    {
        return CartItem::where('cart_id', $cartId)->where('id', $itemId)->first();
    }

    public function incrementQuantity(CartItem $item, int $by = 1): CartItem
    {
        $item->quantity += $by;
        $this->calculateTotal($item);
        return $item->refresh();
    }

    public function decrementQuantity(CartItem $item, int $by = 1): CartItem
    {
        $item->quantity = max(1, $item->quantity - $by);
        $this->calculateTotal($item);
        return $item->refresh();
    }



}
