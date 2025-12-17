<?php

return [

    /*
    |--------------------------------------------------------------------------
    | URLs to Skip From Visit Tracking
    |--------------------------------------------------------------------------
    | Add any URL path here that should NOT be saved in the visits table.
    | Supports wildcards using "/*".
    |
    */

    'skip' => [

        // Exact URLs
        'save-push-notification-sub',
        'logout',
        'login',
        'track-duration',
        '/',
        'livewire/*',
        // Service worker files
        'service-worker.js',
        'manifest.json',
        'favicon.ico',
        'robots.txt',

        // Wildcards
        'admin/*',
        'api/*',
        'storage/*',
    ],
];
