<?php

namespace App\Exceptions;

use App\Http\Controllers\V1\ResponseTrait;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception               $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        $trace = $exception->getTrace();
        $status = config('constant.error');

        if ($exception instanceof AccessDeniedHttpException) {
            // 频道授权失败异常，使用错误码 400 触发授权发起方失败
            return $this->response([], $status, 400, '频道授权失败');
        }

        if ($exception instanceof ServiceException) {
            // 业务异常，默认错误码 400
            return $this->response([], $status, 400, $exception->getMessage());
        }

        if ($exception instanceof ValidationException) {
            // 效验异常，默认错误码 422
            return $this->response([], $status, 422, $exception->getMessage());
        }

        if ($exception instanceof NotFoundHttpException) {
            // 访问不存在的路由，默认错误码 404
            return $this->response([], $status, 404, $exception->getMessage());
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            // 访问路由不存在的方法(GET,POST...)，默认错误码 404
            return $this->response([], $status, 404, $exception->getMessage());
        }

        if ($exception instanceof Exception) {
            // 未定义异常报错
            return $this->response(['trace' => $trace[0]], $status, $exception->getCode(), $exception->getMessage());
        }

        return parent::render($request, $exception);
    }
}
