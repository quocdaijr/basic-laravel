<?php
return [
    'default' => env('ELASTICSEARCH_CONNECTION', 'default'),

    'connections' => [
        'default' => [
            'host' => env('ELASTICSEARCH_HOST', '127.0.0.1'),
            'port' => env('ELASTICSEARCH_PORT', '9200'),
            'username' => env('ELASTICSEARCH_USER', ''),
            'password' => env('ELASTICSEARCH_PASSWORD', ''),
        ]
    ]
];
