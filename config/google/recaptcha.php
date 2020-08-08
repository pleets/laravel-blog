<?php

return [
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
];
