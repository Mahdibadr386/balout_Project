<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Response Macro Success
        Response::macro('success', function ($data = null, string $message = 'عملیات با موفقیت انجام شد', int $status = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data'    => $data,
            ], $status);
        });

        // Response Macro Error
        Response::macro('error', function (string $message = 'خطا در انجام عملیات', $errors = null, int $status = 400) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });


        // Response Macro ValidationError
        Response::macro('validationError', function ($errors, string $message = 'اعتبارسنجی ناموفق بود', int $status = 422) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });
    }
}
