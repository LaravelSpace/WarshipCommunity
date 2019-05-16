<?php

namespace App\Http\Controllers\Community\User;


use App\Community\User\Service\UserService;
use App\Exceptions\ValidateException;
use App\Http\Controllers\WebController;
use App\Http\Requests\Community\User\RegisterRequest;
use Illuminate\Http\Request;

class UserController extends WebController
{
    public function registerPage()
    {
        return view('community.user.register');
    }

    public function registerData(RegisterRequest $request, string $classification)
    {
        $userService = new UserService();
        $inputData = $request->all();

        try {
            $resultData = $userService->register($classification, $inputData);

            return $this->response($resultData);
        } catch (ValidateException $exception) {
            return $this->setStatusCode($exception->getCode())
                ->responseError($exception->getCode(), $exception->getMessage());
        }
    }
}
