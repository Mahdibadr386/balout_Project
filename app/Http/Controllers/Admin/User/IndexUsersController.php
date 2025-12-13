<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\User\UserRepositoryInterface;

class IndexUsersController extends Controller
{
    public function __invoke(UserRepositoryInterface $UserRepository)
    {
        $user = $UserRepository->all();
        if ($user) {
            return response()->success( 'لیست کاربران با موفقیت دریافت شد' ,UserResource::collection($user));
        }

        return response()->error( 'لیست کاربران دریافت نشد');
    }
}
