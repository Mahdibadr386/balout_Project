<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckUserRequest;
use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;

class CheckUser extends Controller
{

    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }
    public function __invoke(CheckUserRequest $request)
    {
        $data = $request->validated();
        $tel = $data['tel'];
        $userExists = $this->authRepo->checkUser($tel);

        return ResponseHelper::success(['user_exists' => $userExists], $userExists ? 'کاربر موجود است' : 'کاربر جدید - نیاز به ثبت ‌نام' , 200);
    }
}
