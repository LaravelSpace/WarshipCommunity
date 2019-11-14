<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiController;
use App\Service\User\UserService;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function register(Request $request)
    {
        $input = $request->input();
        $name = $input['name'];
        $identity = $input['identity'];
        $isEmail = (bool)$input['is_email'];
        $password = $input['password'];

        $result = (new UserService())->register($name, $identity, $isEmail, $password);

        return $this->responseTrans($result);
    }

    public function login(Request $request)
    {
        $input = $request->input();
        $identity = $input['identity'];
        $isEmail = (bool)$input['is_email'];
        $password = $input['password'];

        $result = (new UserService())->login($identity, $isEmail, $password);

        return $this->responseTrans($result);
    }

    public function logout(Request $request)
    {

    }
}
