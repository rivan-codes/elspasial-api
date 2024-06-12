<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'user'),
        'passwords' => 'user',
    ],


    'guards' => [
        'user' => [
            'driver' => 'jwt',
            'provider' => 'user',
        ],
        'driver' => [
            'driver' => 'jwt',
            'provider' => 'driver',
        ]
    ],


    'providers' => [
        'user' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'driver' => [
            'driver' => 'eloquent',
            'model' => App\Models\Driver::class,
        ]
    ],

    'passwords' => [
        'user' => [
            'provider' => 'user',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'driver' => [
            'provider' => 'driver',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ]
    ],

    'password_timeout' => 10800,

];
