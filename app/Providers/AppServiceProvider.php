<?php

namespace App\Providers;

use App\Repositories\Auth\Contracts\AuthRepositoryInterface;
use App\Repositories\Auth\Eloquent\AuthRepository;
use App\Repositories\User\Contracts\UserRepositoryInterface;
use App\Repositories\User\Eloquent\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        require_once app_path('Helpers/ResponseHelper.php');
    }
}
