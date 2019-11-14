<?php

namespace App\Http\Controllers\V1\Web;


use App\Http\Controllers\V1\WebController;
use Illuminate\Http\Request;

class UserController extends WebController
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
