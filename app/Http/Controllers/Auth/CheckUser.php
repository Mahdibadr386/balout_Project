<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckUserRequest;
use App\Repositories\Auth\AuthRepository;


class CheckUser extends Controller
{

    protected $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }
    public function __invoke(CheckUserRequest $request)
    {
        $data = $request->validated();
        $tel = $data['tel'];
        $userExists = $this->authRepo->checkUser($tel);

        return response()->success(['user_exists' => $userExists], $userExists ? 'کاربر موجود است' : 'کاربر جدید - نیاز به ثبت ‌نام', 200);

    }
}
