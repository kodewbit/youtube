<?php

return [

    /*
    |--------------------------------------------------------------------------
    | YOUTUBE API KEY
    |--------------------------------------------------------------------------
    |
    | Here you can define the key to connect to the YouTube API. In case you
    | don't have a key yet, you can get one from the following URL
    | https://console.developers.google.com
    |
    */
    'key' => env('YOUTUBE_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | APPLICATION NAME
    |--------------------------------------------------------------------------
    |
    | Here you can define the name of the application. This value is included
    | in the User-Agent HTTP header. Usually this value is the name of a
    | project that you create using the Google console.
    |
    */
    'name' => env('YOUTUBE_APP_NAME', '')
];
