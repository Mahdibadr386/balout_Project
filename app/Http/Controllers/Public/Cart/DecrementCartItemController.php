<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Cart\ChangeCartItemQuantityRequest;
use App\Http\Resources\Public\Cart\CartItemResource;
use App\Services\Cart\CartService;


class DecrementCartItemController extends Controller
{


    public function __invoke(CartService $CartService,int $item, ChangeCartItemQuantityRequest $request)
    {
        $by = (int) ($request->input('by', 1));
        $userId = auth()->id();
        $updated = $CartService->decrementProduct($userId, $item, $by);

        if ($updated) {
            return response()->success( 'تعداد محصول کاهش یافت',new CartItemResource($updated->load('options.optionDetail', 'product')));
        }

        return response()->error('کاهش تعداد موفقیت‌آمیز نبود');
    }
}
