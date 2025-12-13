<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\Customer\CustomerRepositoryInterface;

class DeleteCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , $id)
    {
        $customer = $CustomerRepository->find($id);

        if (!$customer) return response()->error('مشتری یافت نشد');
        return $CustomerRepository->delete($customer) ? response()->success( 'مشتری با موفقیت حذف شد') : response()->error('حذف مشتری انجام نشد');

    }
}
