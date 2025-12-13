<?php

namespace App\Services;


use App\Repositories\Payment\PaymentTransactionRepositoryInterface;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Gateways\MockPaymentGateway;
use Illuminate\Support\Facades\DB;
use Exception;

class PaymentService
{
    public function __construct(
        protected PaymentTransactionRepositoryInterface $payments,
        protected OrderRepositoryInterface $orders,
        protected MockPaymentGateway $gateway  //For example And test Mock
    ) {}

    public function initiatePayment($payment, array $meta = []): array
    {

        return $this->gateway->initiate($payment, $meta);
    }


    public function handleGatewayCallback(string $gateway, array $payload): array
    {
        $gatewayTxId = $payload['gateway_transaction_id'] ?? null;
        if (!$gatewayTxId) throw new Exception('شناسه‌ی درگاه تراکنش (gateway_transaction_id) الزامی است');

        $tx = $this->payments->findByGatewayTxId($gateway, $gatewayTxId);
        if (!$tx) throw new Exception('تراکنش پرداخت یافت نشد');

        if ($tx->status === 'success') {
            return ['status' => 'already_processed'];
        }

        return DB::transaction(function () use ($tx, $payload) {
            $newStatus = $payload['status'] === 'success' ? 'success' : 'failed';
            $this->payments->updateResponse($tx, $payload, $newStatus);

            $order = $tx->order()->lockForUpdate()->first();

            if ($newStatus === 'success') {

                $this->orders->OrderUpdateStatus($order, 'paid');


                $cart = \App\Models\Cart::where('user_id', $order->user_id)
                    ->whereNull('deleted_at')
                    ->first();

                if ($cart) {
                    $cart->status = 'completed';
                    $cart->save();

                    $cart->delete();
                }

                // fire event
                event(new \App\Events\OrderPlaced($order));

            } else {
                $this->orders->OrderUpdateStatus($order, 'failed');
            }

            return ['status' => $newStatus];
        });
    }
}
