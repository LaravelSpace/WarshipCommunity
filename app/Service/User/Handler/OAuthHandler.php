<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\Token;
use Illuminate\Support\Str;

class OAuthHandler
{
    public function apply()
    {
    }

    public function exchange()
    {
    }

    public function exchangeLocal(int $userId)
    {
        $createField = [
            'client'        => 'web_user',
            'client_id'     => $userId,
            'access_token'  => Str::random(32),
            'expires_at'    => time() + 3600 * 12,
            'refresh_token' => Str::random(32)
        ];
        $dbToken = Token::create($createField);

        $token = ['access_token'=>$dbToken->access_token];

        return ;
    }

    public function validate(string $token)
    {
    }

    public function refresh()
    {
    }

    public function revoke()
    {
    }
}
