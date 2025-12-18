<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User\UserResource;
use App\Interface\UserRepositoryInterface;
use Illuminate\Http\Request;

class IndexUsersController extends Controller
{
    public function __invoke(Request $request,UserRepositoryInterface $UserRepository)
    {
        auth()->user()->hasPermissionTo('user.index') ?: abort(403);

        $filters = $request->only([
            'search',
        ]);

        $user = $UserRepository->all($filters);
        if ($user) {
            return response()->success( 'لیست کاربران با موفقیت دریافت شد' ,UserResource::collection($user));
        }

        return response()->error( 'لیست کاربران دریافت نشد');
    }
}
