<?php

namespace App\Services\Sms\Logger;

interface SmsLoggerInterface
{
    public function logSuccess(string $driver, string $mobile, string $message, int $status, string $response): void;

    public function logError(string $driver, string $mobile, string $message, string $error): void;
}
