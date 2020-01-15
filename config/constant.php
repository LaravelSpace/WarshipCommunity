<?php

return [
    'success' => 'success',
    'fail'    => 'fail',
    'error'   => 'error',

    'classification' => [
        'user'    => 'user',
        'article' => 'article',
        'comment' => 'comment',
    ],

    'http' => [
        'method'      => ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        'status_code' => [200, 400, 403, 404, 418, 422, 500],
        'get'         => 'GET',
    ],

    'route_throttle' => [
        'field'  => ['second', 'minute', 'hour', 'day'],
        'time'   => [
            'second' => 1,
            'minute' => 60,
            'hour'   => 3600,
            'day'    => 86400,
        ],
        'ip'     => [
            'second' => 5,
            'minute' => 60,
            'hour'   => 1200,
            'day'    => 28800,
        ],
        'client' => [
            'second' => 10,
            'minute' => 120,
            'hour'   => 7200,
            'day'    => 172800,
        ]
    ],

    'file_path' => [
        'exception' => '/wsc/temp/log/exception/',
        'log_request'   => '/wsc/temp/log/request/',
        'article'   => '/wsc/article/',
        'comment'   => '/wsc/comment/',
    ],

    'image_path' => [
        'storage'        => '/app/public/image/upload/',
        'public'         => '/storage/image/upload/',
        'default_avatar' => '/storage/image/avatar/default_avatar.jpg',
    ],
];
