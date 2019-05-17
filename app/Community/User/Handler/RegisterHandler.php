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
        $validatorResult = (new RegisterValidator())->validateRegister($inputData, 'sign-up');
        if ($validatorResult['fails']) {
            return $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_422'),
                'data'        => ['errors' => $validatorResult['errors']]
            ];
        }

        return $returnData = (new UserRepository())->userCreate($inputData);
    }

    public function signIn(array $inputData)
    {
        $validatorResult = (new RegisterValidator())->validateRegister($inputData, 'sign-in');
        if ($validatorResult['fails']) {
            return $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_422'),
                'data'        => ['errors' => $validatorResult['errors']]
            ];
        }
    }

    public function signOut(array $inputData)
    {

    }
}
