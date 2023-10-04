<?php

use Illuminate\Support\Str;

return [

    'default' => env('SMS_PROVIDER', 'kavehnegar'),

    'keys' => [

        'kavehnegar' => [
            'provider' => 'kavehnegar',
            'api_key' => env('KAVEHNEGAR_API_KEY'),
            'sender' => env('KAVEHNEGAR_SENDER'),
        ],

        'ghasedak' => [
            'driver' => 'ghasedak',
            'api_key' => env('GHASEDAK_API_KEY'),
            'sender' => env('GHASEDAK_SENDER'),

        ],
    ],
];
