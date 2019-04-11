<?php

namespace App\Http\Controllers\Community\User;


use App\Community\User\Service\UserService;
use App\Http\Controllers\WebController;
use App\Http\Requests\Community\User\RegisterRequest;
use Illuminate\Http\Request;

class UserController extends WebController
{
    public function registerPage()
    {
        return view('community.user.register');
    }

    public function register(RegisterRequest $request, string $classification)
    {
        $userService = new UserService();

        $inputData = $request->all();

        $resultData = $userService->register($classification,$inputData);

        $this->response($resultData);
    }
}
