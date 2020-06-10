<?php

return [
    'recaptcha' => [
        // true | false
        'activated' => env('GOOGLE_RECAPTCHA_ACTIVATED', false),

        'site_key' => env('GOOGLE_RECAPTCHA_SITE_KEY'),
        'secret_key' => env('GOOGLE_RECAPTCHA_SECRET_KEY'),

        'checkbox' => [
            // dark | light
            'theme' => env('', 'light'),

            // compact | normal
            'size' => env('', 'normal'),
        ],
    ],
    'analytics' => [
        // true | false
        'activated' => env('GOOGLE_ANALYTICS_ACTIVATED', false),

        'id' => env('GOOGLE_ANALYTICS_ID'),
    ],
    'ads' => [
        // true | false
        'activated' => env('GOOGLE_ADS_ACTIVATED', false),

        'client' => env('GOOGLE_ADS_CLIENT'),
    ],
];
