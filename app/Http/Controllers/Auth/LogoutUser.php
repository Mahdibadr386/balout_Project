<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;

class LogoutUser extends Controller
{
    public function __invoke(AuthRepository $authRepository, Request $request)
    {
        $authRepository->revokeTokens($request->user());

        return response()->success(null, 'خروج از حساب کاربری با موفقیت انجام شد', 200);

    }
}
