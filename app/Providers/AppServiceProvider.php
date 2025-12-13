<?php

namespace App\Providers;

use App\Exceptions\CustomExceptionHandler;
use App\Repositories\Auth\AuthRepository;
use App\Repositories\Auth\AuthRepositoryInterface;
use App\Repositories\Cart\CartItemRepository;
use App\Repositories\Cart\CartItemRepositoryInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Cart\CartRepositoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\City\CityRepository;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\ContactUs\ContactUsRepository;
use App\Repositories\ContactUs\ContactUsRepositoryInterface;
use App\Repositories\Customer\CustomerRepository;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\Feedback\FeedbackRepository;
use App\Repositories\Feedback\FeedbackRepositoryInterface;
use App\Repositories\Option\OptionDetailRepository;
use App\Repositories\Option\OptionDetailRepositoryInterface;
use App\Repositories\Option\OptionRepository;
use App\Repositories\Option\OptionRepositoryInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\Order\OrderRepositoryInterface;
use App\Repositories\Payment\PaymentTransactionRepository;
use App\Repositories\Payment\PaymentTransactionRepositoryInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Repositories\RolePermission\PermissionRepository;
use App\Repositories\RolePermission\PermissionRepositoryInterface;
use App\Repositories\RolePermission\RoleRepository;
use App\Repositories\RolePermission\RoleRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
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
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(CartItemRepositoryInterface::class, CartItemRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(ContactUsRepositoryInterface::class, ContactUsRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(FeedbackRepositoryInterface::class, FeedbackRepository::class);
        $this->app->bind(OptionRepositoryInterface::class, OptionRepository::class);
        $this->app->bind(OptionDetailRepositoryInterface::class, OptionDetailRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PaymentTransactionRepositoryInterface::class, PaymentTransactionRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        // Response Macro Success
        Response::macro('success', function (string $message = 'عملیات با موفقیت انجام شد', $data = null, int $status = 200) {

            if ($data instanceof ResourceCollection) {
                $response = $data->response()->getData(true);

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data'    => $response['data'] ?? [],
                    'meta'    => $response['meta'] ?? null,
                    'links'   => $response['links'] ?? null,
                ], $status);
            }

            if ($data instanceof AbstractPaginator) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'data'    => $data->items(),
                    'meta'    => [
                        'current_page' => $data->currentPage(),
                        'last_page'    => $data->lastPage(),
                        'per_page'     => $data->perPage(),
                        'total'        => $data->total(),
                    ],
                    'links' => [
                        'next' => $data->nextPageUrl(),
                        'prev' => $data->previousPageUrl(),
                    ],
                ], $status);
            }

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

        // Response Macro Validation
        Response::macro('validationError', function ($errors, string $message = 'اعتبارسنجی ناموفق بود', int $status = 422) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors'  => $errors,
            ], $status);
        });
    }
}

//        Response::macro('success', function ( string $message = 'عملیات با موفقیت انجام شد',$data = null, int $status = 200) {
//            return response()->json([
//                'success' => true,
//                'message' => $message,
//                'data'    => $data,
//            ], $status);
//        });
