<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Resources\Auth\UserResource;
use App\Repositories\Customer\CustomerRepositoryInterface;

class StoreCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , StoreCustomerRequest $request)
    {
        $user = $CustomerRepository->create($request->validated());

        return response()->success( 'مشتری با موفقیت ایجاد شد',new UserResource($user), 201);
    }
}
