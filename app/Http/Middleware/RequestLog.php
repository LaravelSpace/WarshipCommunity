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
        $client = config('client');
        $clientId = config('client_id');

        // 记录请求
        $startTime = microtime(true) * 1000;
        $logData = [
            'ip'        => $request->ip(),
            'client'    => $client,
            'client_id' => $clientId,
            'uri'       => $request->path(),
            'header'    => $request->header(),
            'request'   => $request->all(),
            'time'      => dateTimeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        $response = $next($request);

        // 记录响应
        $endTime = microtime(true) * 1000;
        $logData = [
            'response'    => $response->getContent(),
            'consumption' => (int)$endTime - (int)$startTime,
            'time'        => dateTimeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        return $response;
    }
}
