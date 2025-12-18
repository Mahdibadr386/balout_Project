<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Interface\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class IndexCustomerController extends Controller
{
    public function __invoke(Request $request ,CustomerRepositoryInterface $CustomerRepository)
    {
        auth()->user()->hasPermissionTo('customer.index') ?: abort(403);

        $filters = $request->only([
            'search',
        ]);

        $customer = $CustomerRepository->all($filters);
        if ($customer) {
            return response()->success( 'لیست مشتریان با موفقیت دریافت شد',UserResource::collection($customer),);
        }
        return response()->error( 'لیست مشتریان دریافت نشد');


    }
}
