<?php

namespace App\Http\Controllers;


class WebController extends Controller
{
    /**
     * @var int 状态码
     */
    protected $statusCode = 200;

    /**
     * 获取状态码
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * 设置状态码
     *
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;

        return $this; // 返回 $this 提供链式操作
    }

    /**
     * 请求成功，返回结果
     *
     * @param $data
     *
     * @return mixed
     */
    public function response(array $data)
    {
        return response()->json([
            'status'      => 'success',
            'status_code' => $this->getStatusCode(),
            'data'        => $data,
        ]);
    }

    /**
     * 请求失败，返回错误
     *
     * @param int    $errorCode
     * @param string $message
     *
     * @return mixed
     */
    public function responseError(int $errorCode, string $message)
    {
        return response()->json([
            'status'      => 'failed',
            'status_code' => $this->getStatusCode(),
            'error'       => [
                'error_code' => $errorCode,
                'message'    => $message
            ]
        ]);
    }

    /**
     * 请求失败，返回 404 错误
     *
     * @param string $message
     *
     * @return mixed
     */
    public function responseNotFound(string $message = 'Not Found')
    {
        // 链式操作需要在前面执行的方法返回 $this
        return $this->setStatusCode(404)->responseError(404, $message);
    }
}
