<?php

namespace App\Service\User\Service;


use App\Exceptions\ValidateException;
use App\Service\User\Handler\RegisterHandler;
use App\Service\User\Validator\RegisterValidator;

class UserService
{
    /**
     * @param array  $inputData
     * @param string $classification
     *
     * @return array
     * @throws ValidateException
     */
    public function register(array $inputData, string $classification)
    {
        switch ($classification) {
            case 'signCheck':
                $retultData = $this->signCheck();
                break;
            case 'signIn':
                $retultData = $this->signIn($inputData);
                break;
            case 'signOut':
                $retultData = $this->signOut();
                break;
            case 'signUp':
                $retultData = $this->signUp($inputData);
                break;
            default:
                $message = ValidateException::SWITCH_NON_EXISTENT_CASE . 'CASE=' . $classification;
                throw new ValidateException($message, config('constant.http_code_500'));
        }
        return $retultData;
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

    public function signUp(array $inputData)
    {
        $handler = new RegisterHandler();
        $validatorResult = (new RegisterValidator())->validateRegister($inputData, 'sign-up');
        if ($validatorResult['fails']) {
            return $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_422'),
                'data'        => $validatorResult['errors']
            ];
        }
        return $handler->signUp($inputData);
    }
}
