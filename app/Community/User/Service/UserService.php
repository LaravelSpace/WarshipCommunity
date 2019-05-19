<?php

namespace App\Community\User\Service;


use App\Community\User\Handler\RegisterHandler;
use App\Exceptions\ValidateException;

class UserService
{
    /**
     * @param string $classification
     * @param array  $inputData
     *
     * @return array
     * @throws ValidateException
     */
    public function register(string $classification, array $inputData)
    {
        $handler = new RegisterHandler();
        switch ($classification) {
            case 'check-sign':

                break;
            case 'sign-up':
                $retultData = $handler->signUp($inputData);
                break;
            case 'sign-in':
                $retultData = $handler->signIn($inputData);
                break;
            case 'sign-out':
                $retultData = $handler->signOut($inputData);
                break;
            default:
                $message = ValidateException::SWITCH_NON_EXISTENT_CASE . 'CASE=' . $classification;
                throw new ValidateException($message, config('constant.http_code_500'));
        }
        return $retultData;
    }
}
