<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;

class LogoutUser extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function __invoke(Request $request)
    {
        $this->authRepo->revokeTokens($request->user());

        return ResponseHelper::success(null, 'خروج از حساب کاربری با موفقیت انجام شد' , 200);
    }
}
