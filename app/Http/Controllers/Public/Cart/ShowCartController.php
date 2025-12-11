<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Cart\CartResource;
use App\Services\Cart\CartService;


class ShowCartController extends Controller
{
    public function __invoke(CartService $CartService)
    {
        $userId = auth()->id();
        $cart = $CartService->getCart($userId);

        if (! $cart) {
            return response()->success( 'سبد خرید خالی است' );
        }

        $cart->load('items.product','items.options.optionDetail');
        return response()->success( 'سبد خرید بارگذاری شد' , new CartResource($cart));
    }
}
