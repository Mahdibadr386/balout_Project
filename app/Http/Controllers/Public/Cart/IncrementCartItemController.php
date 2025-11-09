<?php

namespace App\Http\Controllers\Public\Cart;

use App\Http\Controllers\Controller;

use App\Http\Requests\Public\Cart\ChangeCartItemQuantityRequest;
use App\Http\Resources\Public\Cart\CartItemResource;
use App\Services\Cart\CartService;
use Illuminate\Support\Facades\Response;


class IncrementCartItemController extends Controller
{
    public function __construct(protected CartService $service) {}

    public function __invoke(int $item, ChangeCartItemQuantityRequest $request)
    {
        $by = (int) ($request->input('by', 1));
        $userId = auth()->id();
        $updated = $this->service->incrementProduct($userId, $item, $by);

        if ($updated) {
            return Response::success(new CartItemResource($updated->load('options.optionDetail','product')), 'تعداد محصول افزایش یافت', 200);
        }

        return Response::error('افزایش تعداد موفقیت‌آمیز نبود', null, 400);
    }
}
