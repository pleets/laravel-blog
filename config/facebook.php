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
        'layout' => env('FB_SOCIAL_PLUGINS_LAYOUT_HOME', 'standard'),

        // like | recommend
        'action' => env('FB_SOCIAL_PLUGINS_ACTION_HOME', 'like'),

        // small | large
        'size' => env('FB_SOCIAL_PLUGINS_SIZE_HOME', 'small'),

        // true | false
        'share_button' => env('FB_SOCIAL_PLUGINS_SHARE_BUTTON_HOME', 'true'),
    ],

    'posts' => [
        // true | false
        'activated' => env('FB_SOCIAL_PLUGINS_POSTS_ACTIVATED', true),

        // standard | box_count | button_count | button
        'layout' => env('FB_SOCIAL_PLUGINS_LAYOUT_POSTS', 'box_count'),

        // like | recommend
        'action' => env('FB_SOCIAL_PLUGINS_ACTION_POSTS', 'like'),

        // small | large
        'size' => env('FB_SOCIAL_PLUGINS_SIZE_POSTS', 'small'),

        // true | false
        'share_button' => env('FB_SOCIAL_PLUGINS_SHARE_BUTTON_POSTS', 'true'),
    ],
];
