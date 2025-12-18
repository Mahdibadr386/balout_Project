<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Interface\CustomerRepositoryInterface;

class StatusCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , $id)
    {
        auth()->user()->hasPermissionTo('customer.change_status') ?: abort(403);
        $user = $CustomerRepository->find($id);

        if (!$user) return response()->error('مشتری یافت نشد');
        $CustomerRepository->deactivate($user);
        return response()->success( 'مشتری با موفقیت تغییر حالت داده شد',new UserResource($user), );
    }
}
