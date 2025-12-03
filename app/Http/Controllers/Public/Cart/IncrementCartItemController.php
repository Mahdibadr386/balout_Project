<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;

use App\Http\Requests\Public\Cart\ChangeCartItemQuantityRequest;
use App\Http\Resources\Public\Cart\CartItemResource;
use App\Services\Cart\CartService;


class IncrementCartItemController extends Controller
{
    public function __invoke(CartService $CartService , int $item, ChangeCartItemQuantityRequest $request)
    {
        $by = (int) ($request->input('by', 1));
        $userId = auth()->id();
        $updated = $CartService->incrementProduct($userId, $item, $by);

        if ($updated) {
            return response()->success(new CartItemResource($updated->load('options.optionDetail', 'product')), 'تعداد محصول افزایش یافت', 200);
        }

        return response()->error('افزایش تعداد موفقیت‌آمیز نبود', null, 400);
    }
}
