<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Interface\CustomerRepositoryInterface;

class DeleteCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , $id)
    {
        auth()->user()->hasPermissionTo('customer.delete') ?: abort(403);
        $customer = $CustomerRepository->find($id);

        if (!$customer) return response()->error('مشتری یافت نشد');
        return $CustomerRepository->delete($customer) ? response()->success( 'مشتری با موفقیت حذف شد') : response()->error('حذف مشتری انجام نشد');

    }
}
