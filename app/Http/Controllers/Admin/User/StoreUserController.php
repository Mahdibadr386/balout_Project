<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Resources\Auth\UserResource;
use App\Interface\UserRepositoryInterface;

class StoreUserController extends Controller
{
    public function __invoke(StoreUserRequest $request, UserRepositoryInterface $UserRepository)
    {
        auth()->user()->hasPermissionTo('user.store') ?: abort(403);
        $user = $UserRepository->create($request->validated());

        return response()->success( 'کاربر با موفقیت ایجاد شد',new UserResource($user), 201);
    }
}
