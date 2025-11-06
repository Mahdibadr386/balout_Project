<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Repositories\Auth\AuthRepository;

class SendCode extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function __invoke(SendCodeRequest $request)
    {
        $data = $request->validated();
        $response = $this->authRepo->sendCode($data);

        return $response->isNewUser
            ? response()->success(['is_new_user' => true, 'code' => $response->code], 'کد فعالسازی برای تکمیل ثبت نام ارسال شد', 200)
            : response()->success(['is_new_user' => false, 'code' => $response->code], 'کد ورود ارسال شد', 200);

    }
}
