<?php

namespace App\Http\Controllers\V1\Web;


use App\Http\Controllers\V1\WebControllerAbstract;
use Illuminate\Http\Request;

class UserController extends WebControllerAbstract
{
    public function register(Request $request)
    {
        return view('user.register');
    }

    public function login(Request $request)
    {
        return view('user.login');
    }
}
