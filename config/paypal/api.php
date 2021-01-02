<?php

use Pleets\LaravelPayPal\Helpers\Environment;

return [
    Environment::SANDBOX => [
        'credentials' => [
            'client_id' => env('PAYPAL_SANDBOX_CLIENT_ID'),
            'secret' => env('PAYAL_SANDBOX_SECRET'),
        ],
        'endpoint' => 'https://api.sandbox.paypal.com',
    ],
    Environment::LIVE => [
        'credentials' => [
            'client_id' => env('PAYPAL_LIVE_CLIENT_ID'),
            'secret' => env('PAYAL_LIVE_SECRET'),
        ],
        'endpoint' => 'https://api.paypal.com',
    ],
    'environment' => env('PAYPAL_ENVIRONMENT', Environment::SANDBOX)
];
