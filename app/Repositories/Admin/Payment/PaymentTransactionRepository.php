<?php

namespace App\Repositories\Admin\Payment;

use App\Models\PaymentTransaction;

class PaymentTransactionRepository
{
    public function paginate($perPage = 20)
    {
        return PaymentTransaction::query()
            ->with('order:id,order_number,total')
            ->latest()
            ->paginate($perPage);
    }

    public function find($id)
    {
        return PaymentTransaction::query()
            ->with('order:id,order_number,total')
            ->findOrFail($id);
    }
}
