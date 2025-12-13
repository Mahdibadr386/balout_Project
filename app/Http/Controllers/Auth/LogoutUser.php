<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Http\Request;

class LogoutUser extends Controller
{
    public function __invoke(AuthRepositoryInterface $authRepository, Request $request)
    {
        $authRepository->revokeTokens($request->user());

        return response()->success('خروج از حساب کاربری با موفقیت انجام شد');

    }
}
