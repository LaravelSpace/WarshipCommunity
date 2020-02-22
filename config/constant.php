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
        'log_exception'   => 'logs/exception/',
        'log_request'     => 'logs/request/',
        'article_storage' => 'app/article/',
        'comment_storage' => 'app/comment/',
        'image_storage'   => 'app/public/image/upload/',
        'image_public'    => 'storage/image/upload/',
        'default_avatar'  => 'storage/image/avatar/default_avatar.jpg',
    ],
];
