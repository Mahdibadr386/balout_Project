<?php

namespace App\Services\Sms\Facades;

use Illuminate\Support\Facades\Facade;

class Sms extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'sms';
    }

    //USE : Sms::send($number, $text)
}
