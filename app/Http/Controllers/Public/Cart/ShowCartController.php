<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;
use App\Http\Resources\Public\Cart\CartResource;
use App\Services\Cart\CartService;


class ShowCartController extends Controller
{
    public function __construct(protected CartService $service) {}

    public function __invoke()
    {
        $userId = auth()->id();
        $cart = $this->service->getCart($userId);

        if (! $cart) {
            return response()->success(null, 'سبد خرید خالی است', 200);
        }

        $cart->load('items.product','items.options.optionDetail');
        return response()->success(new CartResource($cart), 'سبد خرید بارگذاری شد', 200);
    }
}
