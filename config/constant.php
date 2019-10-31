<?php

return [
    'HTTP_METHOD'      => ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
    'HTTP_STATUS_CODE' => [200, 400, 403, 404, 418, 422, 500],

    'ROUTE_THROTTLE' => ['second', 'minute', 'hour', 'day'],
    'API_LIMIT'      => [
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
            'day'    => 172800
        ],
        'time'   => [
            'second' => 1,
            'minute' => 60,
            'hour'   => 3600,
            'day'    => 86400
        ]
    ],

    'SUCCESS' => 'success',
    'success' => 'success',
    'FAIL'    => 'fail',
    'fail'    => 'fail',
    'ERROR'   => 'error',
    'error'   => 'error',

    'JWT_HEADER' => [
        'RS256' => [
            'alg' => 'RS256',
            'typ' => 'JWT'
        ],
        'HS256' => [
            'alg' => 'HS256',
            'typ' => 'JWT'
        ]
    ],

    'JWT_PAYLOAD' => [
        'iss' => '', // 签发人
        'iat' => '', // 签发时间
        'exp' => '', // 过期时间
        'jti' => '' // 编号
    ],


];
