<?php


namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;
use App\Services\Cart\CartService;
use Illuminate\Http\JsonResponse;

class RemoveCartItemController extends Controller
{
    public function __invoke(int $item, CartService $cartService): JsonResponse
    {
        $userId = auth()->id();

        $removed = $cartService->removeItem($userId, $item);

        if (!$removed) return response()->error('آیتم پیدا نشد یا قابل حذف نبود', null, 404);
        return response()->success(null, 'آیتم با موفقیت حذف شد', 200);



    }
}

