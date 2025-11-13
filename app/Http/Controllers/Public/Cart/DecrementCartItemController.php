<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;

use App\Http\Requests\Public\Cart\ChangeCartItemQuantityRequest;
use App\Http\Resources\Public\Cart\CartItemResource;
use App\Services\Cart\CartService;
use Illuminate\Support\Facades\Response;


class DecrementCartItemController extends Controller
{
    public function __construct(protected CartService $service) {}

    public function __invoke(int $item, ChangeCartItemQuantityRequest $request)
    {
        $by = (int) ($request->input('by', 1));
        $userId = auth()->id();
        $updated = $this->service->decrementProduct($userId, $item, $by);

        if ($updated) {
            return response()->success(new CartItemResource($updated->load('options.optionDetail', 'product')), 'تعداد محصول کاهش یافت', 200);
        }

        return response()->error('کاهش تعداد موفقیت‌آمیز نبود', null, 400);
    }
}
