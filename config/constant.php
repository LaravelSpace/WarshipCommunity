<?php

return [
    'HTTP_METHOD'      => ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
    'HTTP_STATUS_CODE' => [200, 400, 403, 404, 418, 422, 500],

    'API_LIMIT' => [
        'ip'     => [
            'second' => 5,
            'minute' => 60,
            'hour'   => 12,
            'day'    => 5000,
        ],
        'client' => [
            'second' => 10,
            'minute' => 120,
            'hour'   => 5000,
            'day'    => 60000
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
];
