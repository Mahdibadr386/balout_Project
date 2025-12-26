<?php

namespace App\Http\Controllers\Public\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\Checkout\CheckoutRequest;
use App\Http\Resources\Public\Order\OrderResource;
use App\Services\CheckoutService;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;

class CheckoutController extends Controller
{
    public function __invoke(CheckoutService $checkoutService, PaymentService $paymentService, CheckoutRequest $request): JsonResponse
    {
        $user = auth()->user();
        $cart = $user->cart()->with('items.options')->firstOrFail();
        // create order & payment transaction
        $result = $checkoutService->createOrderFromCart($user, $cart, $request->validated());

        // initiate payment with payment service (returns redirect url or token)
        $paymentInit = $paymentService->initiatePayment($result['payment'], [
 //           'return_url' => route('checkout.callback'), // example
            'idempotency_key' => $request->input('idempotency_key'),
        ]);



        return response()->success('سفارش ایجاد شد. به مرحله پرداخت بروید.', ['order' => new OrderResource($result['order']), 'payment' => $paymentInit], 201);

    }
}
