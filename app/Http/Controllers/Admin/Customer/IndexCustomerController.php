<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Admin\Customer\CustomerRepository;
use Illuminate\Http\Request;

class IndexCustomerController extends Controller
{
    public function __invoke(CustomerRepository $CustomerRepository)
    {
        $customer = $CustomerRepository->all();
        if ($customer) {
            return response()->success( 'لیست مشتریان با موفقیت دریافت شد',UserResource::collection($customer),);
        }
        return response()->error( 'لیست مشتریان دریافت نشد');


    }
}
