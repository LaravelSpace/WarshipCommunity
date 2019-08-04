<?php

namespace App\Http\Controllers\User;


use App\Exceptions\ValidateException;
use App\Http\Controllers\WebController;
use App\Service\User\Service\UserService;
use Illuminate\Http\Request;

class UserController extends WebController
{
    public function registerPage(Request $request)
    {
        $inputData = $request->all();

        if (!isset($inputData['target'])) {
            return view('user.sign-in');
        } else {
            $target = $inputData['target'];
        }
        switch ($target) {
            case 'sign-in':
                return view('user.sign-in');
            case 'sign-up':
                return view('user.sign-up');
            default:
                return view('user.sign-in');
        }
    }

    public function signCheck(Request $request)
    {
        $inputData = $request->all();

        return $this->register($inputData, 'signCheck');
    }

    public function signIn(Request $request)
    {
        $inputData = $request->all();

        return $this->register($inputData, 'signIn');
    }

    public function signOut(Request $request)
    {
        $inputData = $request->all();

        return $this->register($inputData, 'signOut');
    }

    public function signUp(Request $request)
    {
        $inputData = $request->all();

        return $this->register($inputData, 'signUp');
    }

    /**
     * @param array  $inputData
     * @param string $classification
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(array $inputData, $classification = '')
    {
        $service = new UserService();
        try {
            $resultData = $service->register($inputData, $classification);

            return $this->response($resultData);
        } catch (ValidateException $exception) {
            return $this->setStatusCode($exception->getCode())
                ->responseError($exception->getCode(), $exception->getMessage());
        }
    }
}
