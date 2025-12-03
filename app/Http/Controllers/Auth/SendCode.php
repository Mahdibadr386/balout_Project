<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Repositories\Auth\AuthRepository;

class SendCode extends Controller
{
    public function __invoke(AuthRepository $authRepository,SendCodeRequest $request)
    {
        $data = $request->validated();
        $response = $authRepository->sendCode($data);

        return $response->isNewUser
            ? response()->success(['is_new_user' => true, 'code' => $response->code], 'کد فعالسازی برای تکمیل ثبت نام ارسال شد', 200)
            : response()->success(['is_new_user' => false, 'code' => $response->code], 'کد ورود ارسال شد', 200);

    }
}
