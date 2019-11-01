<?php

return [
    'success' => 'success',
    'fail'    => 'fail',
    'error'   => 'error',

    'http' => [
        'method'      => ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        'status_code' => [200, 400, 403, 404, 418, 422, 500],
    ],

    'route_throttle' => [
        'field'  => ['second', 'minute', 'hour', 'day'],
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
];
