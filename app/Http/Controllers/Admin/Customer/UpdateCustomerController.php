<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\UpdateCustomerRequest;
use App\Http\Resources\Auth\UserResource;
use App\Interface\CustomerRepositoryInterface;

class UpdateCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , UpdateCustomerRequest $request , $id)
    {
        auth()->user()->hasPermissionTo('customer.update') ?: abort(403);
        $user = $CustomerRepository->find($id);
        if (!$user) return response()->error('مشتری یافت نشد');
        $data = $request->except('addresses', 'password');
        $addresses = $request->addresses ?? [];

        $result = $CustomerRepository->update($user, $data, $addresses);

        return response()->success( 'مشتری با موفقیت تغییر داده شد',new UserResource($result), 201);
    }
}
