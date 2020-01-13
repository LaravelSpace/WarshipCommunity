<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\TokenModel;
use App\Service\User\Model\UserModel;
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
        $time = time();
        $dbToken = TokenModel::where(['client' => 'wsc', 'client_id' => $userId])->first();
        if ($dbToken === null) {
            $createField = [
                'client'        => 'wsc',
                'client_id'     => $userId,
                'access_token'  => Str::random(32),
                'expires_at'    => dateTimeCreate($time + 3600 * 12),
                'refresh_token' => Str::random(32)
            ];
            $dbToken = TokenModel::create($createField);
        } else {
            if ($dbToken->expires_at->lt(dateTimeCreate($time))) {
                $dbToken->access_token = Str::random(32);
                $dbToken->expires_at = dateTimeCreate($time + 3600 * 12);
                $dbToken->save();
            }
        }

        return [
            'user_id' => $dbToken->client_id,
            'token'   => 'WSC ' . $dbToken->client_id . ':' . $dbToken->access_token,
        ];
    }

    /**
     * @param string $client
     * @param int    $clientId
     * @param string $accessToken
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function validate(string $client, int $clientId, string $accessToken)
    {
        $client = strtolower($client);
        $dbToken = TokenModel::where(['client' => $client, 'client_id' => $clientId])->first();
        if ($dbToken === null) {
            renderServiceException('user_not_exist');
        }
        if ($accessToken !== $dbToken->access_token) {
            renderServiceException('access_token_invalid', 403);
        }

        $dbUser = UserModel::query()->where('id', '=', $clientId)->first();
        if ($dbUser === null) {
            renderServiceException('user_not_exist');
        }

        return [
            'user_id' => $dbUser->id,
            'name'    => $dbUser->name,
            'avatar'  => $dbUser->avatar,
        ];
    }

    public function refresh()
    {
    }

    public function revoke()
    {
    }
}
