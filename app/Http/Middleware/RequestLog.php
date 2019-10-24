<?php

namespace App\Http\Middleware;

use App\Events\Common\RequestLogEvent;
use Closure;

class RequestLog
{
    public function handle($request, Closure $next)
    {
        $logKey = makeUniqueKey32();

        $logData = [
            'ip'      => $request->ip(),
            'url'     => $request->path(),
            'request' => $request->all(),
            'time'    => timeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        $response = $next($request);

        $logData = [
            'response' => $response->getContent(),
            'time'     => timeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        return $response;
    }
}
