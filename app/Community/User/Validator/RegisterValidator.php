<?php

namespace App\Community\User\Validator;


use Illuminate\Support\Facades\Validator;

class RegisterValidator
{
    private const IDENTITY_REQUIRED = '登录身份必填';
    private const PASSWORD_REQUIRED = '登录密码必填';
    private const PASSWORD_MIN = '登录密码最少 6 个字符';
    private const PASSWORD_CONFIRMED = '登录密码和确认密码不一致';
    private const PASSWORD_CONFIRMATION_REQUIRED = '确认密码必填';
    private const PASSWORD_CONFIRMATION_MIN = '确认密码最少 6 个字符';

    public function validateRegister(array $inputData, string $description)
    {
        switch ($description) {
            case 'sign-up':
                $rules = [
                    'identity'              => 'required',
                    'password'              => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                ];
                $messages = [
                    'identity.required'              => self::IDENTITY_REQUIRED,
                    'password.required'              => self::PASSWORD_REQUIRED,
                    'password.min'                   => self::PASSWORD_MIN,
                    'password.confirmed'             => self::PASSWORD_CONFIRMED,
                    'password_confirmation.required' => self::PASSWORD_CONFIRMATION_REQUIRED,
                    'password_confirmation.min'      => self::PASSWORD_CONFIRMATION_MIN,
                ];
                break;
            case 'sign-in':
                $rules = [
                    'identity' => 'required',
                    'password' => 'required|min:6',
                ];
                $messages = [
                    'identity.required' => self::IDENTITY_REQUIRED,
                    'password.required' => self::PASSWORD_REQUIRED,
                    'password.min'      => self::PASSWORD_MIN,
                ];
                break;
            default:
                $rules = [
                    'identity'              => 'required',
                    'password'              => 'required|min:6|confirmed',
                    'password_confirmation' => 'required|min:6',
                ];
                $messages = [
                    'identity.required'              => self::IDENTITY_REQUIRED,
                    'password.required'              => self::PASSWORD_REQUIRED,
                    'password.min'                   => self::PASSWORD_MIN,
                    'password.confirmed'             => self::PASSWORD_CONFIRMED,
                    'password_confirmation.required' => self::PASSWORD_CONFIRMATION_REQUIRED,
                    'password_confirmation.min'      => self::PASSWORD_CONFIRMATION_MIN,
                ];
        }
        $validator = Validator::make($inputData, $rules, $messages);

        return $returnData = [
            'fails'  => $validator->fails(),
            'errors' => $validator->errors()->messages()
        ];
    }
}
