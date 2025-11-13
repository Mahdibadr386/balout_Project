<?php
namespace App\Gateways;

use App\Models\PaymentTransaction;

class MockPaymentGateway
{
    public function initiate(PaymentTransaction $payment, array $meta = []): array
    {

        $gatewayTxId = 'MOCK-' . now()->format('YmdHis') . '-' . \Illuminate\Support\Str::random(6);


        $payment->gateway_transaction_id = $gatewayTxId;
        $payment->request_payload = $meta;
        $payment->status = 'pending';
        $payment->save();

        return [
            'gateway' => 'mock',
            'redirect_url' => url("/mock-pay/{$gatewayTxId}"),
            'gateway_transaction_id' => $gatewayTxId,
        ];
    }


    public function verify(array $payload): array
    {
        // payload: ['gateway_tx_id'=>'...','status'=>'success'|'failed','amount'=>...]
        return $payload;
    }
}
