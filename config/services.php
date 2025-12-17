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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'makruzz' => [
        'api_url' => env('MAKRUZZ_API_URL'),
        'username' => env('MAKRUZZ_USERNAME'),
        'password' => env('MAKRUZZ_PASSWORD'),
    ],

    'sealink' => [
    'token' => env('SEALINK_API_TOKEN'),
    'test_token' => env('TEST_SEALINK_API_TOKEN'),
],

'razorpay' => [
    'key' => env('RAZORPAY_API_KEY'),
    'secret' => env('RAZORPAY_API_SECRET'),
    'test_key' => env('RAZORPAY_TEST_API_KEY'),
    'test_secret' => env('RAZORPAY_TEST_API_SECRET'),
],

  'tbo' => [

        'agency_id' => env('TBO_AGENCY_ID'),
        'member_id' => env('TBO_MEMBER_ID'),
        'username_live' => env('TBO_USERNAME_LIVE'),
        'password_live' => env('TBO_PASSWORD_LIVE'),
        'static_username_live' => env('TBO_STATIC_USERNAME_LIVE'),
        'static_password_live' => env('TBO_STATIC_PASSWORD_LIVE'),
        'client_id_live' => env('TBO_CLIENT_ID_LIVE'),
        'hotel_api_url_live' => env('TBO_API_URL_LIVE'),
        'hotel_static_url_live' => env('TBO_STATIC_API_URL_LIVE'),
        'hotel_details_api_url_live' => env('TBO_HOTEL_DETAILS_API_URL_LIVE'),
        'hotel_booking_url_live' => env('TBO_HOTEL_BOOKING_API_URL_LIVE'),  
        'hotel_confirm_url_live' => env('TBO_HOTEL_CONFIRM_LIVE'),  
   
    ],

'google' => [
    'client_id' => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect' => env('GOOGLE_REDIRECT_URI'),
],


];
