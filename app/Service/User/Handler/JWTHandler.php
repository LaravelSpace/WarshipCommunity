<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\User;

class JWTHandler
{
    public function JWTEncrypt(User $user, string $alg = 'HS256')
    {
        $JWTHeader = config('constant.JWT_HEADER');
        if ($alg === 'HS256') {
            $header = $JWTHeader['HS256'];
        } else if ($alg === 'RS256') {
            $header = $JWTHeader['RS256'];
        } else {
            // todo 报错
        }

        $payload = config('constant.JWT_PAYLOAD');
        $payload['user_id'] = $user->id;

        $load = base64_encode(json_encode($header)).'.'.base64_encode(json_encode($payload));
        $sign = hash_hmac($load,);
    }

    public function JWTDecrypt(String $JWTToken, string $alg = 'HS256')
    {

    }
}
