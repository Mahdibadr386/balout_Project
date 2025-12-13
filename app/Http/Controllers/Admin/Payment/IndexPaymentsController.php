<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Payment\PaymentTransactionResource;
use App\Repositories\Payment\PaymentTransactionRepositoryInterface;

class IndexPaymentsController extends Controller
{
    public function __invoke(PaymentTransactionRepositoryInterface $PayRepository)
    {
        $transactions = $PayRepository->paginate();

        if (!$transactions) {
            return response()->error( 'تراکنش ها یافت نشدند.');
        }
        return response()->success('لیست تراکنش پیدا شد.',  PaymentTransactionResource::collection($transactions)  );

    }
}
