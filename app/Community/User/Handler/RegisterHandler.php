<?php

namespace App\Community\User\Handler;


use App\Community\User\Repository\UserRepository;
use App\Community\User\Validator\RegisterValidator;

class RegisterHandler
{
    /**
     * @param $inputData
     *
     * @return array
     */
    public function signUp($inputData)
    {
        $validatorResult = (new RegisterValidator())->validatePasswordConfirm($inputData);
        if ($validatorResult['fails']) {
            return $returnData = [
                'status' => 'failed',
                'data'   => [
                    'errors' => $validatorResult['errors']
                ]
            ];
        }

        return (new UserRepository())->userCreate($inputData);
    }

    public function signIn(array $inputData)
    {

    }

    public function signOut(array $inputData)
    {

    }
}
