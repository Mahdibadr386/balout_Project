<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Admin\User\UserRepository;


class UpdateUserController extends Controller
{
    public function __invoke($id, UpdateUserRequest $request, UserRepository $UserRepository)
    {
        $user = $UserRepository->update($id, $request->validated());

        return response()->success( 'کاربر با موفقیت بروزرسانی شد', new UserResource($user));

    }
}
