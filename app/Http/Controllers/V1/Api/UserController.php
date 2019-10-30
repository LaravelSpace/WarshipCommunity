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
        dd($input);
        $name = $input['name'];
        $identity = $input['identity'];
        $isEmail = (bool)$input['is_email'];
        $password = $input['password'];

        $result = (new UserService())->signUp($name, $identity, $isEmail, $password);
    }

    public function signIn(Request $request)
    {

    }

    public function signOut(Request $request)
    {

    }

    public function signCheck(Request $request)
    {

    }
}
