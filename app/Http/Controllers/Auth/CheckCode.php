<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CheckCodeRequest;
use App\Http\Resources\Auth\AuthResultResource;
use App\Interface\AuthRepositoryInterface;

class CheckCode extends Controller
{
    public function __invoke(AuthRepositoryInterface $authRepository ,  CheckCodeRequest $request)
    {
        $data = $request->validated();
        $result = $authRepository->checkCode($data);

        if (!$result['success']) {
            return response()->error($result['message']);

        }

        return response()->success('کد تایید با موفقیت بررسی شد', new AuthResultResource($result));

    }

}
