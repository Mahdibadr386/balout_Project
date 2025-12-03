<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\User\UserRepository;

class DeleteUserController extends Controller
{
    public function __invoke(UserRepository $UserRepository,$id)
    {
        $user = $UserRepository->find($id);

        if (!$user) return response()->error('کاربر یافت نشد', null, 404);
        return $UserRepository->delete($user) ? response()->success(null, 'کاربر با موفقیت حذف شد', 200) : response()->error('حذف کاربر انجام نشد', null, 400);

    }
}
