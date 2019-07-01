<?php

namespace App\Community\User\Repository;


use App\Community\User\Model\User;;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * @param $inputData
     *
     * @return array
     */
    public function userCreate($inputData)
    {
        $emailName = explode('@', $inputData['identity']);
        $userInfo = [
            'name'           => $emailName[0],
            'email'          => $inputData['identity'],
            'password'       => $inputData['password'],
            'avatar'         => '/images/avatar/default_avatar.jpg',
            'remember_token' => Str::random(64),
        ];
        $newUser = User::create($userInfo);
        if ($newUser !== null && $newUser !== '') {
            $returnData = ['status' => config('constant.success')];
        } else {
            $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_500'),
            ];
        }
        return $returnData;
    }
}
