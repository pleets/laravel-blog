<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Facebook Application ID
    |--------------------------------------------------------------------------
    */

    'fb_app_id' => env('FB_APP_ID', ''),

    /*
    |--------------------------------------------------------------------------
    | Page URL
    |--------------------------------------------------------------------------
    */

    'fb_page_url' => env('FB_PAGE_URL', ''),

    /*
    |--------------------------------------------------------------------------
    | Facebook Social Plugins
    |--------------------------------------------------------------------------
    */

    // en_US, es_LA, ...
    'language' => env('FB_SOCIAL_PLUGINS_LANG', 'en_US'),

    'home' => [
        // true | false
        'activated' => env('FB_SOCIAL_PLUGINS_HOME_ACTIVATED', true),

        // standard | box_count | button_count | button
        'layout' => env('FB_SOCIAL_PLUGINS_HOME_LAYOUT', 'standard'),

        // like | recommend
        'action' => env('FB_SOCIAL_PLUGINS_HOME_ACTION', 'like'),

        // small | large
        'size' => env('FB_SOCIAL_PLUGINS_HOME_SIZE', 'small'),

        // true | false
        'share_button' => env('FB_SOCIAL_PLUGINS_HOME_SHARE_BUTTON', 'true'),
    ],

    'posts' => [
        'starting' => [
            // true | false
            'activated' => env('FB_SOCIAL_PLUGINS_POSTS_STARTING_ACTIVATED', true),

            // standard | box_count | button_count | button
            'layout' => env('FB_SOCIAL_PLUGINS_POSTS_STARTING_LAYOUT', 'box_count'),

            // like | recommend
            'action' => env('FB_SOCIAL_PLUGINS_POSTS_STARTING_ACTION', 'like'),

            // small | large
            'size' => env('FB_SOCIAL_PLUGINS_POSTS_STARTING_SIZE', 'small'),

            // true | false
            'share_button' => env('FB_SOCIAL_PLUGINS_POSTS_STARTING_SHARE_BUTTON', 'true'),
        ],
        'ending' => [
            // true | false
            'activated' => env('FB_SOCIAL_PLUGINS_POSTS_ENDING_ACTIVATED', true),

            // standard | box_count | button_count | button
            'layout' => env('FB_SOCIAL_PLUGINS_POSTS_ENDING_LAYOUT', 'button'),

            // like | recommend
            'action' => env('FB_SOCIAL_PLUGINS_POSTS_ENDING_ACTION', 'like'),

            // small | large
            'size' => env('FB_SOCIAL_PLUGINS_POSTS_ENDING_SIZE', 'large'),

            // true | false
            'share_button' => env('FB_SOCIAL_PLUGINS_POSTS_ENDING_SHARE_BUTTON', 'false'),
        ],
    ],
];
