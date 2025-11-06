<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Resources\Auth\UserResource;
use App\Repositories\Auth\AuthRepository;

class CheckCode extends Controller
{
    protected $authRepo;

    public function __construct(AuthRepository $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function __invoke(CheckCodeRequest $request)
    {
        $data = $request->validated();
        $result = $this->authRepo->checkCode($data);

        if (!$result['success']) {
            return response()->error($result['message'], null, 400);

        }

        return response()->success(['token' => $result['token'], 'user' => new UserResource($result['user']), 'is_new_user' => $result['is_new_user']], 'کد تایید با موفقیت بررسی شد', 200);

    }

}
