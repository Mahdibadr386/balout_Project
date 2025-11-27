<?php

namespace App\Services\Sms\Facades;

use Illuminate\Support\Facades\Facade;


class SmsOtp extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sms-otp';
    }

    //USE: sendOtp($phoneNumber)
    //USE: verifyOtp($phoneNumber, $otp)

}
