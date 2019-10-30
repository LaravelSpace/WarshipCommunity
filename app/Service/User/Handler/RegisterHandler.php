<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RegisterHandler
{
    public function signUp(string $name,string $identity,bool $isEmail,string $password)
    {
        $resultData = $this->checkExistUser($name, $identity, $isEmail, $password);
        if ($resultData['status'] !== config('constant.success')) {
            return $resultData;
        }
        $userInfo = [
            'name'      => $name,
            'password'  => $password,
            'avatar'    => '/images/avatar/default_avatar.jpg',
            'api_token' => Str::random(64)
        ];
        if ($isEmail) {
            $userInfo['email'] = $identity;
        } else {
            $userInfo['phone'] = $identity;
        }
        $dbUser = User::create($userInfo);
        if ($dbUser !== null && $dbUser !== '') {
            $returnData = ['status' => config('constant.success')];
        } else {
            $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_500'),
            ];
        }
        return $returnData;
    }

    public function userCreate($inputData)
    {

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

    public function signCheck()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $returnData = [
                'status' => config('constant.success'),
                'data'   => [
                    'identity_id' => $user->id,
                    'name'        => $user->name,
                    'avatar'      => $user->avatar,
                    'api_token'   => $user->api_token
                ]
            ];
        } else {
            $returnData = [
                'status' => config('constant.success'),
                'data'   => ['identity_id' => 0]
            ];
        }
        return $returnData;
    }

    public function signIn(array $inputData)
    {
        $checkData = [
            'name'      => 'xxx',
            'email'    => $inputData['identity'],
            'password' => $inputData['password'],
            'api_token'=>'111',
            'avatar'=>'111'
        ];
        if (Auth::attempt($checkData)) {
            $user = Auth::user();
            $returnData = [
                'status' => config('constant.success'),
                'data'   => ['identity_id' => $user->id]
            ];
        } else {
            $returnData = [
                'status'      => config('constant.fail'),
                'status_code' => config('constant.http_code_403'),
                'data'        => ['message' => '登录信息错误']
            ];
        }
        return $returnData;
    }

    public function signOut()
    {
        Auth::logout();

        $returnData = ['status' => config('constant.success')];

        return $returnData;
    }


}
