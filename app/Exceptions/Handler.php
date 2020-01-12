<?php

namespace App\Exceptions;

use App\Http\Controllers\V1\ResponseTrait;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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

        // 业务报错，返回 400
        if ($exception instanceof ServiceException) {
            return $this->response(['trace' => $trace[0]], $status, 400, $exception->getMessage());
        }

        // 异常报错，返回 500
        if ($exception instanceof Exception) {
            return $this->response(['trace' => $trace[0]], $status, 500, $exception->getMessage());
        }

        // 访问不存在的路由方法，将返回 404
        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->response(['trace' => $trace[0]], $status, 404, $exception->getMessage());
        }

        return parent::render($request, $exception);
    }
}
