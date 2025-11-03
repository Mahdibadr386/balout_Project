<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;

use App\Http\Resources\Auth\UserResource;
use App\Models\UserAddress;
use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use App\Repositories\Auth\Eloquent\AuthRepository;

class UpdateProfile extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function __invoke(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $data = $request->except('addresses', 'password');
        $addresses = $request->addresses ?? [];

        $updatedUser = $this->authRepo->updateProfile($user, $data, $addresses);

        return ResponseHelper::success(['user' => new UserResource($updatedUser)], 'پروفایل با موفقیت بروزرسانی شد', 200);
    }

}
