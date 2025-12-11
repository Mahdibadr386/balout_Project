<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomerRequest;
use App\Http\Resources\Auth\UserResource;
use App\Repositories\Admin\Customer\CustomerRepository;
use Illuminate\Http\Request;

class StoreCustomerController extends Controller
{
    public function __invoke(CustomerRepository $CustomerRepository , StoreCustomerRequest $request)
    {
        $user = $CustomerRepository->create($request->validated());

        return response()->success( 'مشتری با موفقیت ایجاد شد',new UserResource($user), 201);
    }
}
