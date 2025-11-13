<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Cart\AddCartItemRequest;
use App\Http\Resources\Public\Cart\CartItemResource;
use App\Services\Cart\CartService;



class AddCartItemController extends Controller
{
    public function __construct(protected CartService $service) {}

    public function __invoke(AddCartItemRequest $request)
    {
        $userId = auth()->id();
        $item = $this->service->addProduct($userId, $request->validated());

        if ($item) {
            return response()->success(new CartItemResource($item->load('options.optionDetail', 'product')), 'محصول به سبد اضافه شد', 201);

        }

        return response()->error('افزودن محصول به سبد موفق نبود', null, 400);

    }
}
