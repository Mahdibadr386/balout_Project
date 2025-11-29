<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Admin\User\UserRepository;

class UsersController extends Controller
{
    public function __construct(private UserRepository $repository) {}

    public function __invoke()
    {
        return response()->success(UserResource::collection($this->repository->all()), 'لیست کاربران با موفقیت دریافت شد', 200);

    }
}
