<?php

namespace App\Community\User\Repository;


use App\Community\User\Model\User;
use Illuminate\Support\Str;

class UserRepository
{
    public function userCreate($inputData)
    {
        $resultData = $this->checkExistUser($inputData);
        if ($resultData['status'] !== config('constant.success')) {
            return $resultData;
        }
        $userInfo = [
            'name'      => $inputData['name'],
            'password'  => $inputData['password'],
            'avatar'    => '/images/avatar/default_avatar.jpg',
            'api_token' => Str::random(64)
        ];
        $identityEmail = $inputData['identity_email'];
        $identity = $inputData['identity'];
        if ($identityEmail) {
            $userInfo['email'] = $identity;
        } else {
            $userInfo['phone'] = $identity;
        }
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

    public function checkExistUser($inputData)
    {
        $returnData = ['status' => config('constant.success')];
        $existUserInfo = ['name' => $inputData['name']];
        $existUser = User::where($existUserInfo)->get();
        if (count($existUser) > 0) {
            $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_422'),
                'data'        => ['message' => '昵称已存在']
            ];
        }

        $identityEmail = $inputData['identity_email'];
        $identity = $inputData['identity'];
        if ($identityEmail) {
            $existUserInfo = ['email' => $identity];
            $existUser = User::where($existUserInfo)->get();
            if (count($existUser) > 0) {
                $returnData = [
                    'status'      => config('constant.fail'),
                    'status_code' => config('constant.http_code_422'),
                    'data'        => ['message' => '该邮箱已被使用']
                ];
            }
        } else {
            $existUserInfo = ['phone' => $identity];
            $existUser = User::where($existUserInfo)->get();
            if (count($existUser) > 0) {
                $returnData = [
                    'status'      => config('constant.fail'),
                    'status_code' => config('constant.http_code_422'),
                    'data'        => ['message' => '该手机号码已被使用']
                ];
            }
        }


        return $returnData;
    }
}
