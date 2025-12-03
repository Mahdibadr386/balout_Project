<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Admin\User\UserRepository;

class IndexUsersController extends Controller
{
    public function __invoke(UserRepository $UserRepository)
    {
        return response()->success(UserResource::collection($UserRepository->all()), 'لیست کاربران با موفقیت دریافت شد', 200);

    }
}
