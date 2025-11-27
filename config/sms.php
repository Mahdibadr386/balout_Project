<?php

return [

    'default' => 'rahyab',

    'drivers' => [

        'rahyab' => [
            'api_key' => env('RAHYAB_API_KEY', 'dev'),
            'secret_key' => env('RAHYAB_SECRET_KEY', 'dev'),
            'url' => 'https://api.rahyab.ir/v1/sms/send',
        ],
    ]
];
