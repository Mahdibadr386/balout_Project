<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Admin\User\UserRepository;


class UserStatusController extends Controller
{
    public function __invoke(UserRepository $UserRepository,$id)
    {
        $user = $UserRepository->find($id);

        if (!$user) return response()->error('کاربر یافت نشد');
        $UserRepository->deactivate($user);
        return response()->success( 'کاربر با موفقیت تغییر حالت داده شد', new UserResource($user));

    }
}
