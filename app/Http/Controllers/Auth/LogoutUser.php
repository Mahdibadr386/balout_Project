<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Http\Request;

class LogoutUser extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function __invoke(Request $request)
    {
        $this->authRepo->revokeTokens($request->user());

        return response()->success(null, 'خروج از حساب کاربری با موفقیت انجام شد', 200);

    }
}
