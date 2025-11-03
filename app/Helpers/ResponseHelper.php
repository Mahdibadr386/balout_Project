<?php

namespace App\Helpers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success(
        mixed $data = null,
        string $message = 'عملیات با موفقیت انجام شد',
        int $code = 200
    ): JsonResponse {

        if ($data instanceof JsonResource) {
            $data = $data->response()->getData(true);
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }


    public static function error(
        string $message = 'خطایی رخ داد',
        mixed $data = null,
        int $code = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $data,
        ], $code);
    }

    public static function validation(array $errors, string $message = 'خطا در اعتبارسنجی اطلاعات'): JsonResponse
    {
        return self::error($message, $errors, 422);
    }
}
