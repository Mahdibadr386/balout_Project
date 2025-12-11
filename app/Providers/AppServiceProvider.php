<?php

namespace App\Providers;

use App\Exceptions\CustomExceptionHandler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            ExceptionHandler::class,
            CustomExceptionHandler::class
        );
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        // Response Macro Success
        Response::macro('success', function ( string $message = 'عملیات با موفقیت انجام شد',$data = null, int $status = 200) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data'    => $data,
            ], $status);
        });

        // Response Macro Error
        Response::macro('error', function (string $message = 'خطا در انجام عملیات', $errors = null, int $status = 404) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });
    }
}
