<?php

namespace App\Service\User\Service;


use App\Service\User\Handler\RegisterHandler;

class UserService
{
    public function signUp(string $name, string $identity, bool $isEmail, string $password)
    {
        return (new RegisterHandler())->signUp($name, $identity, $isEmail, $password);
    }

    public function signIn(string $identity, bool $isEmail, string $password)
    {
        return (new RegisterHandler())->signIn($identity, $isEmail, $password);
    }

    public function signRefresh()
    {
        return (new RegisterHandler())->signCheck();
    }

    public function signOut()
    {
        return (new RegisterHandler())->signOut();
    }
}
