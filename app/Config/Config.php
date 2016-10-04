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
    'twitter'     => [
        'oauth_access_token'        => '140728479-iVoH3yEgkgLnQuN28ECBuY5Cc3OYEJdPM6eaLMNN',
        'oauth_access_token_secret' => 'pJgzXEW25kd1mx5cCiBcQFtx6nJJPkv0jDoeC2JFoziFD',
        'consumer_key'              => 'MNdPavJlejJ8V3xAtnO8tKcbl',
        'consumer_secret'           => 'hpNVXLEoGMthPHZN1OS1BlYJukDzGOgwEFzQEaQco79anAbH4i'
    ],

    /**
     * Enable or Disable Redis caching
     */
    'redis_cache' => [
        'enabled' => true,
    ],

    /**
     * Tweet search settings
     * Set hash to get results from specific #hashtags
     * Set min_retweets to tweets with greater or equal re-tweets
     */
    'search'      => [
        'hash'         => '#custserv',
        'min_retweets' => 1
    ]
];
