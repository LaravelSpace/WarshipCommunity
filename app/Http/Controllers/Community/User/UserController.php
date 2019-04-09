<?php

namespace App\Http\Controllers\Community\User;


use App\Http\Controllers\WebController;

class UserController extends WebController
{
    public function pageRegister()
    {
        return view('community.user.register');
    }
}
