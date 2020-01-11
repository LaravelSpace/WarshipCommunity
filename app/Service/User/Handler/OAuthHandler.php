<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\TokenModel;
use Illuminate\Support\Str;

class OAuthHandler
{
    public function apply()
    {
    }

    /**
     * 交换 token
     */
    public function exchange()
    {
    }

    public function exchangeLocal(int $userId)
    {
        $dbToken = TokenModel::where(['client' => 'web_user', 'client_id' => $userId])->first();
        if ($dbToken === null) {
            $createField = [
                'client'        => 'web_user',
                'client_id'     => $userId,
                'access_token'  => Str::random(32),
                'expires_at'    => dateTimeCreate(time() + 3600 * 12),
                'refresh_token' => Str::random(32)
            ];
            $dbToken = TokenModel::create($createField);
        }
        $time = time();
        if ($dbToken->expires_at->lt(dateTimeCreate($time))) {
            $dbToken->expires_at = dateTimeCreate($time + 3600 * 12);
            $dbToken->save();
        }

        return ['token' => 'WSC ' . $dbToken->client_id . ':' . $dbToken->access_token];
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
