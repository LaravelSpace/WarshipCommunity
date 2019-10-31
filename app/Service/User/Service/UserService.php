<?php

namespace App\Service\User\Service;


use App\Exceptions\ValidateException;
use App\Service\User\Handler\RegisterHandler;
use App\Service\User\Validator\RegisterValidator;

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

    public function signCheck()
    {
        $handler = new RegisterHandler();

        return $handler->signCheck();
    }

    public function signOut()
    {
        $handler = new RegisterHandler();

        return $handler->signOut();
    }
}
