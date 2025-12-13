<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Customer\CustomerRepositoryInterface;

class ShowCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , $id)
    {
        $customer = $CustomerRepository->find($id);

        if (!$customer) return response()->error( 'مشتری یافت نشد');
        return response()->success( 'اطلاعات مشتری با موفقیت دریافت شد',new UserResource($customer),);
    }
}
