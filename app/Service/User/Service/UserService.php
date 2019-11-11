<?php

namespace App\Service\User\Service;


use App\Service\User\Handler\RegisterHandler;

class UserService
{
    public function register(string $name, string $identity, bool $isEmail, string $password)
    {
        return (new RegisterHandler())->register($name, $identity, $isEmail, $password);
    }

    public function login(string $identity, bool $isEmail, string $password)
    {
        return (new RegisterHandler())->login($identity, $isEmail, $password);
    }

    public function logout()
    {
        return (new RegisterHandler())->logout();
    }
}
