<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\User\UserRepositoryInterface;


class UpdateUserController extends Controller
{
    public function __invoke($id, UpdateUserRequest $request, UserRepositoryInterface $UserRepository)
    {
        $user = $UserRepository->find($id);
        if (!$user) {
           return response()->error( 'کاربر مورد نطر یافت نشد');
        }
        $user = $UserRepository->update($user, $request->validated());
        return response()->success( 'کاربر با موفقیت بروزرسانی شد', new UserResource($user));

    }
}
