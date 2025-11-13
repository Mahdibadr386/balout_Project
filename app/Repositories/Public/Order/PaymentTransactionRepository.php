<?php

namespace App\Repositories\Public\Order;

use App\Models\PaymentTransaction;

class PaymentTransactionRepository
{
    public function create(array $data): PaymentTransaction
    {
        return PaymentTransaction::create($data);
    }

    public function findByGatewayTxId(string $gateway, string $gatewayTxId)
    {
        return PaymentTransaction::where('gateway', $gateway)
            ->where('gateway_transaction_id', $gatewayTxId)
            ->first();
    }

    public function findByIdempotencyKey(string $key)
    {
        return PaymentTransaction::where('idempotency_key', $key)->first();
    }

    public function updateResponse(PaymentTransaction $tx, array $response, string $status): PaymentTransaction
    {
        $tx->response_payload = $response;
        $tx->status = $status;
        $tx->save();
        return $tx;
    }
}
