<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;

class ProfileUser extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->success(new UserResource($request->user()), 'اطلاعات کاربر با موفقیت دریافت شد', 200);

    }
}
