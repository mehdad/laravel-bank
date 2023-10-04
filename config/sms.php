<?php

use Illuminate\Support\Str;

return [

    'default' => env('SMS_PROVIDER', 'kavenegar'),

    'configs' => [
        'kavenegar' => [
            'api_key' => env('KAVENEGAR_API_KEY'),
            'sender' => env('KAVENEGAR_SENDER'),
        ],
        'ghasedak' => [
            'api_key' => env('GHASEDAK_API_KEY'),
            'sender' => env('GHASEDAK_SENDER'),
        ],
    ],
];
