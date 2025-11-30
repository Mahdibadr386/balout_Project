<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Repositories\Admin\User\UserRepository;
use Illuminate\Http\Request;

class UserStatusController extends Controller
{
    public function __construct(private UserRepository $repository) {}

    public function __invoke($id)
    {
        $user = $this->repository->find($id);

        if (!$user) return response()->error('کاربر یافت نشد', null, 404);
        $this->repository->deactivate($user);
        return response()->success(new UserResource($user), 'کاربر با موفقیت غیرفعال شد', 200);

    }
}
