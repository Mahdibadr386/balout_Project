<?php

namespace App\Services\Sms\Logger;

use App\Models\SmsLog;

class SmsLogger implements SmsLoggerInterface
{
    public function logSuccess(string $driver, string $mobile, string $message, int $status, string $response): void
    {
        SmsLog::create([
            'driver'      => $driver,
            'mobile'      => $mobile,
            'message'     => $message,
            'status_code' => $status,
            'response'    => $response,
        ]);
    }

    public function logError(string $driver, string $mobile, string $message, string $error): void
    {
        SmsLog::create([
            'driver' => $driver,
            'mobile' => $mobile,
            'message'=> $message,
            'error'  => $error,
        ]);
    }
}
