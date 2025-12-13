<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Customer\CustomerRepositoryInterface;

class IndexCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository)
    {
        $customer = $CustomerRepository->all();
        if ($customer) {
            return response()->success( 'لیست مشتریان با موفقیت دریافت شد',UserResource::collection($customer),);
        }
        return response()->error( 'لیست مشتریان دریافت نشد');


    }
}
