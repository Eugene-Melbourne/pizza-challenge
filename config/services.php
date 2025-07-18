<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'public_website_api' => [
        'url' => env('PUBLIC_WEBSITE_API_URL'),
        'basic_auth' => [
            'is_active' => env('PUBLIC_WEBSITE_API_BASIC_AUTH_IS_ACTIVE', true),
            'username' => env('PUBLIC_WEBSITE_API_BASIC_AUTH_USERNAME'),
            'password' => env('PUBLIC_WEBSITE_API_BASIC_AUTH_PASSWORD'),
        ],
        'encryption' => [
            'is_active' => env('PUBLIC_WEBSITE_API_ENCRYPTION_IS_ACTIVE', true),
            'cipher' => env('PUBLIC_WEBSITE_API_ENCRYPTION_CIPHER', 'AES-256-CBC'),
            'key' => env('PUBLIC_WEBSITE_API_ENCRYPTION_KEY'),
        ],
    ],

];
