<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |
      | This file is for storing the credentials for third party services such
      | as Stripe, Mailgun, SparkPost and others. This file provides a sane
      | default location for this type of information, allowing packages
      | to have a conventional place to find your various credentials.
      |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '701439403342179',
        'client_secret' => '8f8222c771145400fcf9060bea9cf153',
        'redirect' => 'http://books.dev/facebook-callback',
    ],
    'twitter' => [
        'client_id' => '8UtVhH4KiwnkBrpalfEHkSzSm',
        'client_secret' => 'vw08Gso7dMDv8vkapw1MoyVBC1Pw8FHeOyEDxFSdec6jmA6MsX',
        'redirect' => 'http://books.dev/twitter-callback',
    ],
    'google' => [
        'client_id' => '313208046462-j153goj7a8ut7ksu1hbm3c7kqop8mqj3.apps.googleusercontent.com',
        'client_secret' => 'xUw99mMI14HsYiy6b3oTjKAW',
        'redirect' => 'http://books.dev/google-callback',
    ],
   
];
