<?php

namespace App\Providers;

use App\Exceptions\CustomExceptionHandler;
use App\Interface\AddressRepositoryInterface;
use App\Interface\AuthRepositoryInterface;
use App\Interface\Cart\CartItemRepositoryInterface;
use App\Interface\Cart\CartRepositoryInterface;
use App\Interface\CategoryRepositoryInterface;
use App\Interface\ContactUsRepositoryInterface;
use App\Interface\CustomerRepositoryInterface;
use App\Interface\DiscountRepositoryInterface;
use App\Interface\FeedbackRepositoryInterface;
use App\Interface\GetDateRepositoryInterface;
use App\Interface\Option\OptionDetailRepositoryInterface;
use App\Interface\Option\OptionRepositoryInterface;
use App\Interface\OrderRepositoryInterface;
use App\Interface\PaymentTransactionRepositoryInterface;
use App\Interface\PermissionRepositoryInterface;
use App\Interface\ProductRepositoryInterface;
use App\Interface\RoleRepositoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Repositories\Mysql\AddressRepository;
use App\Repositories\Mysql\AuthRepository;
use App\Repositories\Mysql\Cart\CartItemRepository;
use App\Repositories\Mysql\Cart\CartRepository;
use App\Repositories\Mysql\CategoryRepository;
use App\Repositories\Mysql\ContactUsRepository;
use App\Repositories\Mysql\CustomerRepository;
use App\Repositories\Mysql\DiscountRepository;
use App\Repositories\Mysql\FeedbackRepository;
use App\Repositories\Mysql\GetDateRepository;
use App\Repositories\Mysql\Option\OptionDetailRepository;
use App\Repositories\Mysql\Option\OptionRepository;
use App\Repositories\Mysql\OrderRepository;
use App\Repositories\Mysql\PaymentTransactionRepository;
use App\Repositories\Mysql\PermissionRepository;
use App\Repositories\Mysql\ProductRepository;
use App\Repositories\Mysql\RoleRepository;
use App\Repositories\Mysql\UserRepository;
use App\Services\Discount\DiscountService;
use App\Services\Discount\DiscountServiceInterface;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        $this->app->bind(DiscountRepositoryInterface::class, DiscountRepository::class);
        $this->app->bind(DiscountServiceInterface::class, DiscountService::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(GetDateRepositoryInterface::class, GetDateRepository::class);

    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Passport::tokensExpireIn(now()->addDays(7));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addDays(7));


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

