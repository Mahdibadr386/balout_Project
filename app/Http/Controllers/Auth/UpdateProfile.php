<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\UserResource;
use App\Interface\AuthRepositoryInterface;


class UpdateProfile extends Controller
{
    public function __invoke(AuthRepositoryInterface $authRepository, UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->except('addresses', 'password');
        $addresses = $request->addresses ?? [];

        $updatedUser = $authRepository->updateProfile($user, $data, $addresses);

        return response()->success( 'پروفایل با موفقیت بروزرسانی شد',['user' => new UserResource($updatedUser)]);

    }

}
