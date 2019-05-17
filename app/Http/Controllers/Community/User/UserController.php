<?php

namespace App\Http\Controllers\Community\User;


use App\Community\User\Service\UserService;
use App\Exceptions\ValidateException;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class UserController extends WebController
{
    public function registerPage(Request $request)
    {
        $inputData = $request->all();
        if (isset($inputData['target']) && $inputData['target'] === 'sign-up') {
            return view('community.user.sign-up');
        } else {
            return view('community.user.sign-in');
        }
    }

    public function registerData(Request $request, string $classification)
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
