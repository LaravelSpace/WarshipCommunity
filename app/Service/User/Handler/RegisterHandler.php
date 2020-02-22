<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\UserModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterHandler
{
    /**
     * @param string $name
     * @param string $identity
     * @param string $password
     * @param bool   $isEmail
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function register(string $name, string $identity, string $password, bool $isEmail)
    {
        $this->checkExistUser($name, $identity, $isEmail);

        $userInfo = [
            'name'           => $name,
            'password'       => $password,
            'avatar'         => config('constant.file_path.default_avatar'),
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
        if (empty($dbUser)) {
            gRenderServiceException('user_create_failed');
        }

        return ['user_id' => $dbUser->id];
    }

    /**
     * @param string $name
     * @param string $identity
     * @param bool   $isEmail
     * @throws \App\Exceptions\ServiceException
     */
    public function checkExistUser(string $name, string $identity, bool $isEmail)
    {
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
            gRenderServiceException($message);
        }
    }

    /**
     * @param string $identity
     * @param string $password
     * @param bool   $isEmail
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function login(string $identity, string $password, bool $isEmail)
    {
        if ($isEmail) {
            $checkField['email'] = $identity;
        } else {
            $checkField['phone'] = $identity;
        }
        $dbUser = UserModel::where($checkField)->first();
        if (empty($dbUser)) {
            gRenderServiceException('user_not_exist');
        }

        $checkResult = Hash::check($password, $dbUser->password);
        if (!$checkResult) {
            gRenderServiceException('password_incorrect', 403);
        }

        return (new OAuthHandler())->exchangeLocal($dbUser->id);
    }

    public function logout()
    {
        return [];
    }
}
