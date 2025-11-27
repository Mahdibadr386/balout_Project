<?php

namespace App\Services\Sms;

use App\Services\Sms\Drivers\RahyabDriver;
use App\Services\Sms\Exceptions\SmsException;
use App\Services\Sms\Logger\SmsLoggerInterface;

class SmsManager
{
    protected array $drivers = [];
    protected string $defaultDriver;

    public function __construct()
    {
        $this->defaultDriver = config('sms.default', 'rahyab');
    }

    public function driver(?string $name = null): SmsInterface
    {
        $name = $name ?? $this->defaultDriver;

        if (!isset($this->drivers[$name])) {
            $this->drivers[$name] = $this->resolve($name);
        }

        return $this->drivers[$name];
    }

    public function resolve(string $name): SmsInterface
    {
        return match ($name) {
            'rahyab' => new RahyabDriver(
                config('sms.drivers.rahyab.apikey'),
                app(SmsLoggerInterface::class)
            ),
            default  => throw new SmsException("Driver {$name} تعریف نشده."),
        };
    }

}
