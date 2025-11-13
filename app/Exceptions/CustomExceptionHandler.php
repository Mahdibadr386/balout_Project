<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Throwable;

class CustomExceptionHandler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {

        if ($request->expectsJson()) {


            if ($e instanceof ValidationException) {
                return response()->validationError(
                    $e->errors(),
                    'داده‌های ارسالی معتبر نیستند.'
                );
            }


            if ($e instanceof ModelNotFoundException) {
                $model = class_basename($e->getModel());
                return response()->error("{$model} مورد نظر یافت نشد.", null, 404);
            }


            if ($e instanceof NotFoundHttpException) {
                return response()->error('آدرس مورد نظر یافت نشد.', null, 404);
            }

            if ($e instanceof MethodNotAllowedHttpException) {
                return response()->error('متد درخواست مجاز نیست.', null, 405);
            }


            if ($e instanceof AuthenticationException) {
                return response()->error('احراز هویت انجام نشده است.', null, 401);
            }

            if ($e instanceof AuthorizationException) {
                return response()->error('شما مجوز انجام این عملیات را ندارید.', null, 403);
            }


            if ($e instanceof ThrottleRequestsException) {
                return response()->error('تعداد درخواست‌های شما بیش از حد مجاز است.', null, 429);
            }


            if ($e instanceof QueryException) {
                if (config('app.debug')) {
                    return response()->error('خطای پایگاه داده.', [
                        'sql' => $e->getSql(),
                        'bindings' => $e->getBindings(),
                        'message' => $e->getMessage(),
                    ], 500);
                }
                return response()->error('در ارتباط با پایگاه داده خطایی رخ داده است.', null, 500);
            }


            if ($e instanceof HttpResponseException) {
                return $e->getResponse();
            }


            if (config('app.debug')) {
                return response()->error('خطای غیرمنتظره رخ داده است.', [
                    'exception' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => collect($e->getTrace())->take(5),
                ], 500);
            }

            return response()->error('خطای غیرمنتظره‌ای رخ داده است.', null, 500);
        }

        return parent::render($request, $e);
    }
}
