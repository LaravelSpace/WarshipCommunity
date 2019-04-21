<?php

namespace App\Community\User\Service;


use App\Community\User\Handler\RegisterHandler;

class UserService
{
    /**
     * @param string $classification
     * @param array  $inputData
     *
     * @return array
     */
    public function register(string $classification, array $inputData)
    {
        $handler = new RegisterHandler();
        switch ($classification) {
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
                $retultData = [];
        }

        return $retultData;
    }
}
