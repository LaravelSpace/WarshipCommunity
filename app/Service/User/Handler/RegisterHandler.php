<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterHandler
{
    public function register(string $name, string $identity, bool $isEmail, string $password)
    {
        $checkResult = $this->checkExistUser($name, $identity, $isEmail);
        if ($checkResult['status'] !== config('constant.success')) {
            return $checkResult;
        }

        $userInfo = [
            'name'           => $name,
            'password'       => $password,
            'avatar'         => '/images/avatar/default_avatar.jpg',
            'api_token'      => Str::random(32),
            'remember_token' => Str::random(32),
        ];
        if ($isEmail) {
            $userInfo['email'] = $identity;
            $userInfo['phone'] = $name;
        } else {
            $userInfo['phone'] = $identity;
            $userInfo['email'] = $name;
        }
        $dbUser = UserModel::create($userInfo);
        if ($dbUser !== null && $dbUser !== '') {
            $result = [
                'status' => config('constant.success'),
                'data'   => ['user_id' => $dbUser->id],
            ];
        } else {
            $result = [
                'status'  => config('constant.fail'),
                'message' => '用户创建失败',
            ];
        }

        return $result;
    }

    public function checkExistUser(string $name, string $identity, bool $isEmail)
    {
        $result = ['status' => config('constant.success')];

        if ($isEmail) {
            $orWhereField = ['email' => $identity];
        } else {
            $orWhereField = ['phone' => $identity];
        }
        $dbUserList = UserModel::where(['name' => $name])->orWhere($orWhereField)->get();
        if (count($dbUserList) > 0) {
            $message = '';
            foreach ($dbUserList as $itemUser) {
                if ($itemUser->name == $name) {
                    $message .= "昵称\"{$name}\"，已被使用;";
                }
                if ($itemUser->email == $identity) {
                    $message .= "邮箱地址\"{$identity}\"，已被使用;";
                }
                if ($itemUser->phone == $identity) {
                    $message .= "手机号码\"{$identity}\"，已被使用;";
                }
            }
            $result = [
                'status'  => config('constant.fail'),
                'message' => $message,
            ];
        }

        return $result;
    }

    public function login(string $identity, bool $isEmail, string $password)
    {
        if ($isEmail) {
            $checkField['email'] = $identity;
        } else {
            $checkField['phone'] = $identity;
        }

        $user = UserModel::where($checkField)->first();
        $checkResult = Hash::check($password, $user->password);
        if ($checkResult) {
            $result = [
                'status' => config('constant.success'),
                'data'   => (new OAuthHandler())->exchangeLocal($user->id)
            ];
        } else {
            $result = [
                'status'      => config('constant.fail'),
                'status_code' => 403,
                'message'     => '登录信息错误',
            ];
        }

        return $result;
    }

    public function logout()
    {
        return [];
    }
}
