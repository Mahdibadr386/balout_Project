<?php

namespace App\Services\Sms;

use Illuminate\Support\ServiceProvider;
use App\Services\Sms\Logger\SmsLogger;
use App\Services\Sms\Logger\SmsLoggerInterface;

class SmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Logger binding
        $this->app->singleton(SmsLoggerInterface::class, SmsLogger::class);

        // SMS Manager
        $this->app->singleton(SmsManager::class, function ($app) {
            return new SmsManager();
        });

        // SMS Service
        $this->app->singleton('sms', function ($app) {
            return new SmsService(
                $app->make(SmsManager::class)
            );
        });

        // SMS OTP Service
        $this->app->singleton('sms-otp', function ($app) {
            return new SmsOtpService(
                $app->make('sms'),
                $app->make(SmsLoggerInterface::class)
            );
        });

    }

    public function boot()
    {
        $this->mergeConfigFrom(config_path('sms.php'), 'sms');

        $this->publishes([
            config_path('sms.php') => config_path('sms.php'),
        ]);
    }
}
