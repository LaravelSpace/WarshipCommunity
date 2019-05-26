<?php

namespace App\Community\User\Service;


use App\Community\User\Handler\RegisterHandler;
use App\Exceptions\ValidateException;

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
        $handler = new RegisterHandler();
        switch ($classification) {
            case 'signCheck':
                $retultData = $handler->signCheck($inputData);
                break;
            case 'signUp':
                $retultData = $handler->signUp($inputData);
                break;
            case 'signIn':
                $retultData = $handler->signIn($inputData);
                break;
            case 'signOut':
                $retultData = $handler->signOut($inputData);
                break;
            default:
                $message = ValidateException::SWITCH_NON_EXISTENT_CASE . 'CASE=' . $classification;
                throw new ValidateException($message, config('constant.http_code_500'));
        }
        return $retultData;
    }
}
