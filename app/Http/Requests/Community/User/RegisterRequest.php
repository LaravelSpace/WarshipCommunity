<?php

namespace App\Http\Requests\Community\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username'              => 'required',
            'password'              => 'required|min:6',
            // 'password'              => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required|min:6',
        ];
    }

    public function messages()
    {
        return [
            'username.required'              => '登录身份必填',
            'password.required'              => '登录密码必填',
            'password.min'                   => '登录密码最少 6 个字符',
            // 'password.confirmed'             => '登录密码和确认密码不一致',
            // 'password_confirmation.required' => '确认密码必填',
            // 'password_confirmation.min'      => '确认密码最少 6 个字符',
        ];
    }
}
