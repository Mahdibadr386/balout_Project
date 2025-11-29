<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Admin\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserRepository $repository) {}

    public function __invoke($id)
    {
        $user = $this->repository->find($id);

        if (!$user) return response()->error('کاربر یافت نشد', null, 404);
        return response()->success(new UserResource($user), 'اطلاعات کاربر با موفقیت دریافت شد', 200);

    }
}
