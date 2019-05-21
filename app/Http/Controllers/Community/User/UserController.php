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

        if (!isset($inputData['target'])) {
            return view('community.user.sign-in');
        } else {
            $target = $inputData['target'];
        }
        switch ($target) {
            case 'sign-in':
                return view('community.user.sign-in');
                break;
            case 'sign-up':
                return view('community.user.sign-up');
                break;
            default:
                return view('community.user.sign-in');
        }
    }

    public function signCheck(Request $request)
    {
        $inputData = $request->all();

        return $this->registerData($inputData, 'sign-check');
    }

    public function signUp(Request $request)
    {
        $inputData = $request->all();

        return $this->registerData($inputData, 'sign-up');
    }

    public function signIn(Request $request)
    {
        $inputData = $request->all();

        return $this->registerData($inputData, 'sign-in');
    }

    public function signOut(Request $request)
    {
        $inputData = $request->all();

        return $this->registerData($inputData, 'sign-out');
    }

    /**
     * @param array  $inputData
     * @param string $classification
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function registerData(array $inputData, $classification = '')
    {
        $userService = new UserService();
        try {
            $resultData = $userService->register($inputData, $classification);

            return $this->response($resultData);
        } catch (ValidateException $exception) {
            return $this->setStatusCode($exception->getCode())
                ->responseError($exception->getCode(), $exception->getMessage());
        }
    }
}
