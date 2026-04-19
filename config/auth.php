<?php

use App\Models\Admin;
use App\Models\Member;

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'admin'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'admins'),
    ],

    'guards' => [
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'member' => [
            'driver' => 'session',
            'provider' => 'members',
        ],
    ],

    'providers' => [
        'admins' => [
            'driver' => 'eloquent',
            'model' => Admin::class,
        ],
        'members' => [
            'driver' => 'eloquent',
            'model' => Member::class,
        ],
    ],

    'passwords' => [
        'admins' => [
            'provider' => 'admins',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
        'members' => [
            'provider' => 'members',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
