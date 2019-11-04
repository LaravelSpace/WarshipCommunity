<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 自定义参数
    |--------------------------------------------------------------------------
    |
    | header.alg [签名算法]
    | header.typ [令牌的类型]
    |
    | payload.iss [签发人(issuer)]
    | payload.sub [主题(subject)]
    | payload.aud [受众(audience)]
    | payload.iat [签发时间(issued at)]
    | payload.nbf [生效时间(not before)]
    | payload.exp [过期时间(expiration time)]
    | payload.jti [编号(JWT ID)]
    | payload.access_token [JWT ID(编号)]
    | payload.refresh_token [JWT ID(编号)]
    | payload.scope [权限]
    |
    */

    'header' => [
        'alg' => 'HS256',
        'typ' => 'JWT'
    ],

    'payload' => [
        'iss' => 'admin',
        'iat' => '',
        'exp' => '',
        'jti' => ''
    ]

];
