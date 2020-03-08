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

    public function index(Request $request)
    {
        return view('user.index');
    }

    public function info(Request $request)
    {
        return view('user.info');
    }

    public function avatar(Request $request)
    {
        return view('user.avatar');
    }
}
