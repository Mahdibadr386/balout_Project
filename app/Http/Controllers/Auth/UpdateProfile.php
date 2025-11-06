<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Resources\Auth\UserResource;
use App\Repositories\Auth\AuthRepository;


class UpdateProfile extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function __invoke(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->except('addresses', 'password');
        $addresses = $request->addresses ?? [];

        $updatedUser = $this->authRepo->updateProfile($user, $data, $addresses);

        return response()->success(['user' => new UserResource($updatedUser)], 'پروفایل با موفقیت بروزرسانی شد', 200);

    }

}
