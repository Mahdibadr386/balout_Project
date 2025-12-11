<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Payment\PaymentTransactionResource;
use App\Repositories\Admin\Payment\PaymentTransactionRepository;


class ShowPaymentController extends Controller
{
    public function __invoke(PaymentTransactionRepository $PayRepository ,$id)
    {
        $transaction = $PayRepository->find($id);

        if (!$transaction) {
            return response()->error( 'تراکنش یافت نشد.');
        }


        return response()->success( 'تراکنش پیدا شد.' , new PaymentTransactionResource($transaction)  );
    }
}
