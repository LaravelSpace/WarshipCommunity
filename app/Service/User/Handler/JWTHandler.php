<?php

namespace App\Service\User\Handler;


class JWTHandler
{
    // 未使用 JWT

    /**
     * @param int $userId
     * @return string
     */
    public function makeJWT(int $userId)
    {
        $header = config('constant.jwt.header');
        $payload = config('constant.jwt.payload');
        $payload['iat'] = time();
        $payload['exp'] = time() + 3600 * 24;
        $payload['jti'] = md5($userId);
        $payload['user_id'] = $userId;

        $load = base64_encode(json_encode($header)) . '.' . base64_encode(json_encode($payload));
        $JWTPublicKey = config('jwt.keys.public');
        $sign = base64_encode(hash_hmac('sha256', $load, $JWTPublicKey));
        $JWTToken = 'Bearer ' . $load . '.' . $sign;

        return $JWTToken;
    }

    /**
     * @param String $JWTToken
     * @return bool
     */
    public function checkJWT(String $JWTToken)
    {
        $JWTToken = str_replace('Bearer ', '', $JWTToken);
        list($header, $payload, $sign) = explode('.', $JWTToken);

        $load = $header . '.' . $payload;
        $JWTPublicKey = config('jwt.keys.public');
        $checkSign = base64_encode(hash_hmac('sha256', $load, $JWTPublicKey));

        if ($sign === $checkSign) {
            return true;
        }
        return false;
    }
}
