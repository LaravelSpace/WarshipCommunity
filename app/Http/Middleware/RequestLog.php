<?php

namespace App\Http\Middleware;

use App\Events\Common\RequestLogEvent;
use Closure;
use Illuminate\Http\Request;

class RequestLog
{
    public function handle(Request $request, Closure $next)
    {
        $logKey = makeUniqueKey32();

        // 从 header 获取认证信息
        $client = 'web_user';
        $clientId = 998;
        $authorization = $request->header('Authorization', null);
        if ($authorization !== null && is_string($authorization)) {
            list($clientStr, $authStr) = explode(':', $authorization);
            list($classfication, $clientId) = explode(' ', $clientStr);
        }

        // 记录请求
        $logData = [
            'ip'        => $request->ip(),
            'client'    => $client,
            'client_id' => $clientId,
            'uri'       => $request->path(),
            'header'    => $request->header(),
            'request'   => $request->all(),
            'time'      => timeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        $response = $next($request);

        // 记录响应
        $logData = [
            'response' => $response->getContent(),
            'time'     => timeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        return $response;
    }
}
