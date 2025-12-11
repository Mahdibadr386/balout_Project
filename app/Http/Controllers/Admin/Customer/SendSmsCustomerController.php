<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\MessageCustomerRequest;
use App\Repositories\Admin\Customer\CustomerRepository;

class SendSmsCustomerController extends Controller
{
    public function __invoke(CustomerRepository $CustomerRepository ,  MessageCustomerRequest $request ,  $id)
    {
        $user = $CustomerRepository->find($id);
        if (!$user) return response()->error('مشتری یافت نشد');

        $data = $request->validated();
        $message = $data['message'];

        $result = $CustomerRepository->sendSms($user , $message);

        if (!$result) return response()->error('پیام ارسال نشد' , 400);
        return response()->success( 'پیام با موفقیت برای مشتری ارسال شد');
    }
}
