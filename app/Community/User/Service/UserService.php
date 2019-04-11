<?php

namespace App\Community\User\Service;


class UserService
{
    public function register(string $classification, array $inputData)
    {
        switch ($classification){
            case 'sign-up':
                $this->iSignUp($inputData);
                break;
            case 'sign-in':
                $this->iSignIn($inputData);
                break;
            case 'sign-out':
                $this->iSignOut($inputData);
                break;
            default:
        }
    }

    private function iSignUp(array $inputData)
    {
        $emailName = explode('@', $inputData['username']);
        $userInfo = [
            'name'           => $emailName[0],
            'email'          => $inputData['username'],
            'password'       => $inputData['password'],
            'avatar'         => '/image/avatar/default_avatar.jpg',
            'remember_token' => str_random(64),
        ];
        \Log::info($userInfo);
    }

    private function iSignIn(array $inputData)
    {

    }

    private function iSignOut(array $inputData)
    {

    }
}
