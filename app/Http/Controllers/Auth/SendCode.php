<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Repositories\Auth\AuthRepositoryInterface;

class SendCode extends Controller
{
    public function __invoke(AuthRepositoryInterface $authRepository,SendCodeRequest $request)
    {
        $data = $request->validated();
        $response = $authRepository->sendCode($data);

        return $response->isNewUser
            ? response()->success( 'کد فعالسازی برای تکمیل ثبت نام ارسال شد', ['is_new_user' => true, 'code' => $response->code])
            : response()->success( 'کد ورود ارسال شد',['is_new_user' => false, 'code' => $response->code] );

    }
}
