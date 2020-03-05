<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Service\User\UserService;
use Illuminate\Http\Request;

class UserController extends ApiControllerAbstract
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function register(Request $request)
    {
        $input = $request->input();
        $name = $input['name'];
        $identity = $input['identity'];
        $password = $input['password'];
        $isEmail = (bool)$input['is_email'];

        $result = (new UserService())->register($name, $identity, $password, $isEmail);

        return $this->response($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function login(Request $request)
    {
        $input = $request->input();
        $identity = $input['identity'];
        $password = $input['password'];
        $isEmail = (bool)$input['is_email'];

        $result = (new UserService())->login($identity, $password, $isEmail);

        return $this->response($result);
    }

    public function logout(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function loginCheck(Request $request)
    {
        $authorization = $request->header('authorization', '');

        $result = (new UserService())->tokenCheck($authorization);

        return $this->response($result);
    }

    public function getSignCalendar(Request $request)
    {
        $userId = config('client_id');
        $result = (new UserService())->getSignCalendar($userId);

        return $this->response($result);
    }

    public function markSignCalendar(Request $request)
    {
        $userId = config('client_id');
        $result = (new UserService())->markSignCalendar($userId);

        return $this->response($result);
    }
}
