<?php

namespace App\Http\Middleware;


use App\Exceptions\ValidationException;
use Closure;
use Illuminate\Http\Request;

class RequestValidate
{
    /**
     * @var \App\Http\Validator\ValidatorAbstract
     */
    protected $validator;

    public function handle(Request $request, Closure $next)
    {
        // 获取路由调用的控制器类名
        $controllerName = get_class($request->route()->getController());
        $controllerNameArr = explode('\\', $controllerName);
        $className = end($controllerNameArr);
        $className = str_replace('Controller', '', $className);
        // 获取路由调用的控制器方法名
        $methodName = $request->route()->getActionMethod();
        // 组合校验器类名
        $validatorName = '\App\Http\Validator\\' . $className . 'Validator';
        if (class_exists($validatorName)) {
            try {
                $validateData = $request->all();
                $this->validator = new $validatorName($methodName);
                $this->validator->validate($validateData);
            } catch (ValidationException $e) {
            }
        }

        return $next($request);
    }
}
