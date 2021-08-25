<?php

if (file_exists(base_path('modules/Core/Config/sidebar.php')))
    return require_once base_path('modules/Core/Config/sidebar.php');
else
    return [
        /*
        |--------------------------------------------------------------------------
        | Caching
        |--------------------------------------------------------------------------
        |
        | Define the way the Sidebar should be cached.
        | The cache store is defined by the Laravel
        |
        | Available: null|static|user-based
        |
        */
        'cache' => [
            'method' => null,
            'duration' => 1440
        ]
    ];
