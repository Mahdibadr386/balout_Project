<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Customer\CustomerRepository;
use Illuminate\Http\Request;

class DeleteCustomerController extends Controller
{
    public function __invoke(CustomerRepository $CustomerRepository , $id)
    {
        $customer = $CustomerRepository->find($id);

        if (!$customer) return response()->error('مشتری یافت نشد');
        return $CustomerRepository->delete($customer) ? response()->success( 'مشتری با موفقیت حذف شد') : response()->error('حذف مشتری انجام نشد');

    }
}
