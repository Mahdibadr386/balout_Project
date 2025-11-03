<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendCodeRequest;
use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;

class SendCode extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function __invoke(SendCodeRequest $request)
    {
        $data = $request->validated();
        $response = $this->authRepo->sendCode($data);

        return $response->isNewUser
            ? ResponseHelper::success(['is_new_user' => true, 'code' => $response->code], 'کد فعالسازی برای تکمیل ثبت نام ارسال شد', 200)
            : ResponseHelper::success(['is_new_user' => false, 'code' => $response->code], 'کد ورود ارسال شد', 200);
    }
}
