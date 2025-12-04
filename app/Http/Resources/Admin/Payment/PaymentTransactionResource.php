<?php

namespace App\Http\Resources\Admin\Payment;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentTransactionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'order' => $this->whenLoaded('order', function () {
                return [
                    'id' => $this->order->id,
                    'order_number' => $this->order->order_number,
                    'total' => $this->order->total,
                ];
            }),
            'gateway'                => $this->gateway,
            'gateway_transaction_id' => $this->gateway_transaction_id,
            'amount'                 => $this->amount,
            'currency'               => $this->currency,
            'status'                 => $this->status,
            'request_payload'        => $this->request_payload,
            'response_payload'       => $this->response_payload,
            'idempotency_key'        => $this->idempotency_key,
            'created_at'             => $this->created_at,
            'deleted_at'             => $this->deleted_at,
        ];
    }
}
