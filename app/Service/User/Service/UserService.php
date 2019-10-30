<?php

namespace App\Service\User\Service;


use App\Exceptions\ValidateException;
use App\Service\User\Handler\RegisterHandler;
use App\Service\User\Validator\RegisterValidator;

class UserService
{
    public function signUp(string $name,string $identity,bool $isEmail,string $password)
    {
        return (new RegisterHandler())->signUp($name, $identity, $isEmail, $password);
    }

    public function signCheck()
    {
        $handler = new RegisterHandler();

        return $handler->signCheck();
    }

    public function signIn(array $inputData)
    {
        $handler = new RegisterHandler();
        $validatorResult = (new RegisterValidator())->validateRegister($inputData, 'sign-in');
        if ($validatorResult['fails']) {
            return $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_422'),
                'data'        => $validatorResult['errors']
            ];
        }
        return $handler->signIn($inputData);
    }

    public function signOut()
    {
        $handler = new RegisterHandler();

        return $handler->signOut();
    }


}
