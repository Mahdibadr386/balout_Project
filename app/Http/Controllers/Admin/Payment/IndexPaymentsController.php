<?php

namespace App\Http\Controllers\Admin\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Payment\PaymentTransactionResource;
use App\Repositories\Admin\Payment\PaymentTransactionRepository;

class IndexPaymentsController extends Controller
{
    public function __invoke(PaymentTransactionRepository $PayRepository)
    {
        $transactions = $PayRepository->paginate();

        if (!$transactions) {
            return response()->error( null,'تراکنش ها یافت نشدند.', 404);
        }
        return response()->success( PaymentTransactionResource::collection($transactions)  ,'لیست تراکنش پیدا شد.', 200);

    }
}
