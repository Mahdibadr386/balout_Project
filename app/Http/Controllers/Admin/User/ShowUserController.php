<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\User\UserRepositoryInterface;

class ShowUserController extends Controller
{
    public function __invoke(UserRepositoryInterface $UserRepository,$id)
    {
        $user = $UserRepository->find($id);

        if (!$user) return response()->error('کاربر یافت نشد');
        return response()->success('اطلاعات کاربر با موفقیت دریافت شد',new UserResource($user));

    }
}
