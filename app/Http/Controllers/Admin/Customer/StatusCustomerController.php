<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Customer\CustomerRepositoryInterface;

class StatusCustomerController extends Controller
{
    public function __invoke(CustomerRepositoryInterface $CustomerRepository , $id)
    {
        $user = $CustomerRepository->find($id);

        if (!$user) return response()->error('مشتری یافت نشد');
        $CustomerRepository->deactivate($user);
        return response()->success( 'مشتری با موفقیت تغییر حالت داده شد',new UserResource($user), );
    }
}
