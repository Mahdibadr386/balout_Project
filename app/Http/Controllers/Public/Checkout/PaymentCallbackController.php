<?php

namespace App\Http\Controllers\Public\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    public function __invoke(PaymentService $paymentService , Request $request): JsonResponse
    {

        $payload = $request->all();
        $gateway = $request->route('gateway') ?? 'mock';

        try {
            $result = $paymentService->handleGatewayCallback($gateway, $payload);
            return response()->success($result, 200);
        } catch (\Exception $e) {
            Log::error('Payment callback error: '.$e->getMessage(), ['payload' => $payload]);
            return response()->error($e->getMessage(), 400);
        }
    }
}
