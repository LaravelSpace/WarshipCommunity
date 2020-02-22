<?php

namespace App\Http\Middleware;

use App\Events\Common\RequestLogEvent;
use Closure;
use Illuminate\Http\Request;

class RequestLog
{
    public function handle(Request $request, Closure $next)
    {
        // GET 请求不记录日志
        $method = $request->getMethod();
        $methodGet = config('constant.get');
        if (strtoupper($method) === $methodGet) {
            return $next($request);
        }

        $logKey = gMakeUniqueKey32();
        $client = config('client');
        $clientId = config('client_id');
        $actionName = $request->route()->getActionName();
        $actionArr = explode('\\', $actionName);
        list($controller, $action) = explode('@', end($actionArr));

        // 记录请求
        $startTime = microtime(true) * 1000;
        $logData = [
            'ip'         => $request->ip(),
            'client'     => $client,
            'client_id'  => $clientId,
            'controller' => $controller,
            'action'     => $action,
            'header'     => $request->header(),
            'request'    => $request->all(),
            'time'       => gDateTimeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        $response = $next($request);

        // 记录响应
        $endTime = microtime(true) * 1000;
        $logData = [
            'response'    => $response->getContent(),
            'consumption' => (int)$endTime - (int)$startTime,
            'time'        => gDateTimeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        return $response;
    }
}
