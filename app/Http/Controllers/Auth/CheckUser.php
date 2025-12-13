<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckUserRequest;
use App\Repositories\Auth\AuthRepositoryInterface;


class CheckUser extends Controller
{
    public function __invoke(AuthRepositoryInterface $authRepository , CheckUserRequest $request)
    {
        $data = $request->validated();
        $tel = $data['tel'];
        $userExists = $authRepository->checkUser($tel);

        return response()->success(['user_exists' => $userExists], $userExists ? 'کاربر موجود است' : 'کاربر جدید - نیاز به ثبت ‌نام');

    }
}
