<?php

namespace App\Service\User;


use App\Service\User\Handler\OAuthHandler;
use App\Service\User\Handler\RegisterHandler;

class UserService
{
    /**
     * @param string $name
     * @param string $identity
     * @param string $password
     * @param bool   $isEmail
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function register(string $name, string $identity, string $password, bool $isEmail)
    {
        return (new RegisterHandler())->register($name, $identity, $password, $isEmail);
    }

    /**
     * @param string $identity
     * @param string $password
     * @param bool   $isEmail
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function login(string $identity, string $password, bool $isEmail)
    {
        return (new RegisterHandler())->login($identity, $password, $isEmail);
    }

    public function logout()
    {
        return (new RegisterHandler())->logout();
    }

    /**
     * @param $authorization
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function tokenCheck($authorization)
    {
        if (!is_string($authorization) || $authorization === '') {
            gRenderServiceException('authorization_invalid');
        }
        list($clientStr, $authStr) = explode(':', $authorization);
        list($client, $clientId) = explode(' ', $clientStr);

        return (new OAuthHandler)->validate($client, $clientId, $authStr);
    }
}
