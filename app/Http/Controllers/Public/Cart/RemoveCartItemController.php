<?php


namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;


class RemoveCartItemController extends Controller
{
    public function __invoke(int $item, CartService $CartService)
    {
        $userId = auth()->id();

        $removed = $CartService->removeItem($userId, $item);

        if (!$removed) return response()->error('آیتم پیدا نشد یا قابل حذف نبود', null, 404);
        return response()->success(null, 'آیتم با موفقیت حذف شد', 200);



    }
}

