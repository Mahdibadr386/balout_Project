<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;

class DeleteUserController extends Controller
{
    public function __invoke(UserRepositoryInterface $UserRepository,$id)
    {
        $user = $UserRepository->find($id);

        if (!$user) return response()->error('کاربر یافت نشد');
        return $UserRepository->delete($user) ? response()->success( 'کاربر با موفقیت حذف شد') : response()->error('حذف کاربر انجام نشد',  400);

    }
}
