<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Payment\PaymentTransactionResource;
use App\Interface\PaymentTransactionRepositoryInterface;


class ShowPaymentController extends Controller
{
    public function __invoke(PaymentTransactionRepositoryInterface $PayRepository ,$id)
    {
        auth()->user()->hasPermissionTo('payment.show') ?: abort(403);
        $transaction = $PayRepository->find($id);

        if (!$transaction) {
            return response()->error( 'تراکنش یافت نشد.');
        }


        return response()->success( 'تراکنش پیدا شد.' , new PaymentTransactionResource($transaction)  );
    }
}
