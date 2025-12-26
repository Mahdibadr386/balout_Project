<?php

return [

    'default' => 'sep',

    /*
    |--------------------------------------------------------------------------
    | Payment Drivers
    |--------------------------------------------------------------------------
    */
    'drivers' => [

        'sep' => [
            'merchantId'  => env('SEP_MERCHANT_ID'),
            'terminalId'  => env('SEP_TERMINAL_ID'),
            'password'    => env('SEP_PASSWORD'),
            'callbackUrl' => env('SEP_CALLBACK_URL'),
        ],

    ],

];
