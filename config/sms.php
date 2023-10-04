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
            'sender' => env('GHASEDAK_LINENUMBER'),
        ],
    ],
];
