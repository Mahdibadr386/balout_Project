<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\User\UserRepository;

class DeleteUserController extends Controller
{
    public function __construct(private UserRepository $repository) {}

    public function __invoke($id)
    {
        $user = $this->repository->find($id);

        if (!$user) return response()->error('کاربر یافت نشد', null, 404);
        return $this->repository->delete($user) ? response()->success(null, 'کاربر با موفقیت حذف شد', 200) : response()->error('حذف کاربر انجام نشد', null, 400);

    }
}
