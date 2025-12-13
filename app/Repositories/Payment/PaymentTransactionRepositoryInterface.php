<?php

namespace App\Repositories\Payment;

use App\Models\PaymentTransaction;

interface PaymentTransactionRepositoryInterface
{
    /** Get paginated list of payment transactions */
    public function paginate();

    /** Find a payment transaction by ID */
    public function find($id);

    /** Create a new payment transaction */
    public function create(array $data): PaymentTransaction;

    /** Find a transaction by gateway and gateway transaction ID */
    public function findByGatewayTxId(string $gateway, string $gatewayTxId);

    /** Find a transaction by idempotency key */
    public function findByIdempotencyKey(string $key);

    /** Update the response payload and status of a transaction */
    public function updateResponse(PaymentTransaction $tx, array $response, string $status): PaymentTransaction;
}
