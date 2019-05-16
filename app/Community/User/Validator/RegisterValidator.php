<?php

namespace App\Community\User\Validator;


use Illuminate\Support\Facades\Validator;

class RegisterValidator
{
    public function validatePasswordConfirm(array $inputData)
    {
        $rules = [
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
        ];
        $messages = [
            'password.confirmed'             => '登录密码和确认密码不一致',
            'password_confirmation.required' => '确认密码必填',
            'password_confirmation.min'      => '确认密码最少 6 个字符',
        ];
        $validator = Validator::make($inputData, $rules, $messages);

        return $returnData = [
            'fails'  => $validator->fails(),
            'errors' => $validator->errors()->messages()
        ];
    }
}
