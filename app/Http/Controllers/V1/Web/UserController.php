<?php

namespace App\Http\Controllers\V1\Web;


use App\Http\Controllers\V1\WebController;
use Illuminate\Http\Request;

class UserController extends WebController
{
    public function signUp(Request $request)
    {
        return view('user.sign-up');
    }

    public function signIn(Request $request)
    {
        return view('user.sign-in');
    }
}
