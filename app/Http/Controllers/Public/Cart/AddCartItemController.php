<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Cart\AddCartItemRequest;
use App\Http\Resources\Public\Cart\CartItemResource;
use App\Services\Cart\CartService;



class AddCartItemController extends Controller
{
    public function __invoke(CartService $CartService ,AddCartItemRequest $request)
    {
        $userId = auth()->id();
        $item = $CartService->addProduct($userId, $request->validated());

        if ($item) {
            return response()->success( 'محصول به سبد اضافه شد',new CartItemResource($item->load('options.optionDetail', 'product')));

        }

        return response()->error('افزودن محصول به سبد موفق نبود');

    }
}
