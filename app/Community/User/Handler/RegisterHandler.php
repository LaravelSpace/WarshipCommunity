<?php

namespace App\Community\User\Handler;


use App\Community\User\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;

class RegisterHandler
{
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
            'email'    => $inputData['identity'],
            'password' => $inputData['password']
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

    public function signUp($inputData)
    {
        $returnData = (new UserRepository())->userCreate($inputData);

        return $returnData;
    }
}
