<?php

/*
|--------------------------------------------------------------------------
| Settings
|--------------------------------------------------------------------------
|
| The service providers listed here will be automatically loaded on the
| request to your application. Feel free to add your own services to
|
*/

return [
    /**
     * Twitter Settings
     */
    'twitter' => [
        'oauth_access_token'        => '',
        'oauth_access_token_secret' => '',
        'consumer_key'              => '',
        'consumer_secret'           => ''
    ],

    /**
     * Enable or Disable Redis caching
     */
    'redis_cache' => [
        'enabled' => true,
    ]
];
