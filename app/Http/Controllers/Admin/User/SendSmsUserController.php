<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\MessageUserRequest;
use App\Repositories\User\UserRepositoryInterface;


class SendSmsUserController extends Controller
{
    public function __invoke(UserRepositoryInterface $UserRepository , MessageUserRequest $request , $id)
    {
        $user = $UserRepository->find($id);
        if (!$user) return response()->error('کاربر یافت نشد');

        $data = $request->validated();
        $message = $data['message'];

        $result = $UserRepository->sendSms($user , $message);

        if (!$result) return response()->error('پیام ارسال نشد');
        return response()->success('پیام با موفقیت برای کاربر ارسال شد');
    }
}
