<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Resources\Auth\UserResource;
use App\Interface\CustomerRepositoryInterface;

class StoreCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , StoreCustomerRequest $request)
    {
        auth()->user()->hasPermissionTo('customer.store') ?: abort(403);
        $user = $CustomerRepository->create($request->validated());

        return response()->success( 'مشتری با موفقیت ایجاد شد',new UserResource($user), 201);
    }
}
