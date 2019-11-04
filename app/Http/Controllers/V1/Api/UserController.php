<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiController;
use App\Service\User\Service\UserService;
use Illuminate\Http\Request;

class UserController extends ApiController
{
    public function signUp(Request $request)
    {
        $input = $request->input();
        $name = $input['name'];
        $identity = $input['identity'];
        $isEmail = (bool)$input['is_email'];
        $password = $input['password'];

        $result = (new UserService())->signUp($name, $identity, $isEmail, $password);

        return $this->responseTrans($result);
    }

    public function signIn(Request $request)
    {
        $input = $request->input();
        $identity = $input['identity'];
        $isEmail = (bool)$input['is_email'];
        $password = $input['password'];

        $result = (new UserService())->signIn($identity, $isEmail, $password);

        return $this->responseTrans($result);
    }

    public function signCheck(Request $request)
    {

    }

    public function signOut(Request $request)
    {
        $input = $request->input();
        $identity = $input['identity'];
        $isEmail = (bool)$input['is_email'];
        $token = $input['token'];

        $result = (new UserService())->signOut($identity, $isEmail, $password);

        return $this->responseTrans($result);
    }
}
