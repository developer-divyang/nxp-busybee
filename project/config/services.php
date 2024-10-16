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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'genius' => [
        'ocean' => 'https://geniusocean.com/verify/'
    ],

    'stripe' => [
        'key' => 'pk_test_51Q8nvQ06842rfI09e4R05zG8KzMt76H4bl9fuAvyx6r5j96wkvNdAR9Tk9UyGRJx7glvudfHtPIYpEDSCxMYE71a006ORr3Gaq',
        'secret' => 'sk_test_51Q8nvQ06842rfI09yfqSwBVXBDuhmWJCj1Xriv8fObHn1jVs4cIIQbJ3TpInWNq1wPKBiXT6jZN0dwOFUONDTzEq00zgDJTo3z',
        'secret_live' => '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',
    ],

];
