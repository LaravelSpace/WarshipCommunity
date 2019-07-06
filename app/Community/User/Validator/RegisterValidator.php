<?php

namespace App\Community\User\Validator;


use Illuminate\Support\Facades\Validator;

class RegisterValidator
{
    private const NAME_REQUIRED = '昵称为空';
    private const NAME_MIN = '昵称最少 2 个字符';
    private const NAME_MAX = '昵称最多 16 个字符';
    private const IDENTITY_MODEL_REQUIRED = '登录身份选项为空';
    private const IDENTITY_REQUIRED = '登录身份为空';
    private const PASSWORD_REQUIRED = '登录密码为空';
    private const PASSWORD_MIN = '登录密码最少 6 个字符';
    private const PASSWORD_MAX = '登录密码最多 32 个字符';

    public function validateRegister(array $inputData, string $description)
    {
        switch ($description) {
            case 'sign-up':
                $rules = [
                    'name'           => 'required|min:2|max:16',
                    'identity_email' => 'required',
                    'identity'       => 'required',
                    'password'       => 'required|min:6|max:32',
                ];
                $messages = [
                    'name.required'           => self::NAME_REQUIRED,
                    'name.min'                => self::NAME_MIN,
                    'name.max'                => self::NAME_MAX,
                    'identity_email.required' => self::IDENTITY_MODEL_REQUIRED,
                    'identity.required'       => self::IDENTITY_REQUIRED,
                    'password.required'       => self::PASSWORD_REQUIRED,
                    'password.min'            => self::PASSWORD_MIN,
                    'password.max'            => self::PASSWORD_MAX
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
                $rules = [];
                $messages = [];
        }
        $validator = Validator::make($inputData, $rules, $messages);

        return $returnData = [
            'fails'  => $validator->fails(),
            'errors' => $validator->errors()->messages()
        ];
    }
}
