<?php

namespace App\Services;


use App\Gateways\MockPaymentGateway;
use App\Interface\OrderRepositoryInterface;
use App\Interface\PaymentTransactionRepositoryInterface;
use App\Models\PaymentTransaction;
use Exception;
use Illuminate\Support\Facades\DB;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;
use Shetabit\Payment\Facade\Payment;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function __construct(
        protected PaymentTransactionRepositoryInterface $payments,
        protected OrderRepositoryInterface $orders,
        protected MockPaymentGateway $mockGateway
    ) {}

    public function initiatePayment(PaymentTransaction $payment, array $meta = []): array
    {
        //Local test
        if ($payment->gateway === 'mock') {
            return $this->mockGateway->initiate($payment, $meta);
        }

        //saman gateway
        if ($payment->gateway === 'saman' || $payment->gateway === 'sep') {
            return $this->initiateSepPayment($payment);
        }

        throw new Exception('درگاه پرداخت پشتیبانی نمی‌شود');
    }



    public function handleGatewayCallback(string $gateway, array $payload): array
    {

        if ($gateway !== 'sep') {
            throw new Exception('درگاه نامعتبر است');
        }


        $refNum = $payload['RefNum'] ?? null;
        $state  = $payload['State'] ?? null;

        if (!$refNum) {
            throw new Exception('RefNum در callback وجود ندارد');
        }

        return DB::transaction(function () use ($refNum, $state, $payload) {


            $tx = PaymentTransaction::where('gateway', 'sep')
                ->where(function ($q) use ($refNum) {
                    $q->where('gateway_transaction_id', $refNum)
                        ->orWhereNull('gateway_transaction_id');
                })
                ->lockForUpdate()
                ->first();

            if (!$tx) {
                throw new Exception('تراکنش پرداخت یافت نشد');
            }


            if ($tx->status === 'success') {
                return ['status' => 'already_processed'];
            }


            if (!$tx->gateway_transaction_id) {
                $tx->update([
                    'gateway_transaction_id' => $refNum,
                ]);
            }


            if ($state !== 'OK') {
                $this->failTransaction($tx, $payload);
                return ['status' => 'failed'];
            }

            try {

                Payment::via('sep')
                    ->amount((int) $tx->amount)
                    ->transactionId($refNum)
                    ->verify();


                $this->successTransaction($tx, $payload);

                return ['status' => 'success'];

            } catch (InvalidPaymentException $e) {


                $this->failTransaction($tx, $payload);

                Log::warning('SEP verify failed', [
                    'ref_num' => $refNum,
                    'error' => $e->getMessage(),
                ]);

                throw $e;
            }
        });
    }


    protected function successTransaction(PaymentTransaction $tx, array $payload): void
    {
        $tx->update([
            'status' => 'success',
            'response_payload' => $payload,
        ]);

        $order = $tx->order()->lockForUpdate()->first();
        $this->orders->OrderUpdateStatus($order, 'paid');

        event(new \App\Events\OrderPlaced($order));
    }

    protected function failTransaction(PaymentTransaction $tx, array $payload): void
    {
        $tx->update([
            'status' => 'failed',
            'response_payload' => $payload,
        ]);

        $order = $tx->order()->lockForUpdate()->first();
        $this->orders->OrderUpdateStatus($order, 'failed');
    }

    protected function initiateSepPayment(PaymentTransaction $payment): array
    {
        $order = $payment->order;

        $payment->update([
            'status' => 'pending',
            'request_payload' => [
                'order_id' => $order->id,
                'amount' => $payment->amount,
            ],
        ]);

        $pay = Payment::via('sep')
            ->amount((int) $payment->amount)
            ->detail('order_number', $order->order_number)
            ->callbackUrl(route('payment.callback', ['gateway' => 'sep']))
            ->pay();

        return [
            'gateway' => 'sep',
            'redirect_url' => $pay->getAction(),
            'method' => $pay->getMethod(),
            'inputs' => $pay->getInputs(),
        ];
    }


}


