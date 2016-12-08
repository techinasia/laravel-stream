<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Application
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the applications below you wish to use as
    | your default application for all work.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Applications
    |--------------------------------------------------------------------------
    |
    | Here you may configure the authentication information for each Stream
    | application that is used by your Laravel application.
    |
     */

    'applications' => [
        'main' => [
            'key' => env('GETSTREAM_API_KEY', ''),
            'secret' => env('GETSTREAM_API_SECRET', ''),
        ],
    ],
];
