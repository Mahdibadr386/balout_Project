<?php

return [

    'default' => env('SMS_DRIVER', 'rahyab'),

    'drivers' => [

        'rahyab' => [
            'url' => env('RAHYAB_SMS_BASE_URL'),
            'api_key' => env('RAHYAB_SMS_API_KEY'),

            'from' => [
                'service'   => env('RAHYAB_SMS_NUMBER_SERVICE'),
                'advertise' => env('RAHYAB_SMS_NUMBER_ADVERTISE'),
            ],
        ],

    ],

];
