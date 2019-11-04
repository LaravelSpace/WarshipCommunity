<?php

namespace App\Http\Middleware;

use App\Events\Common\RequestLogEvent;
use Closure;

class RequestLog
{
    public function handle($request, Closure $next)
    {
        $logKey = makeUniqueKey32();

        $client = 'web_user';
        $authorization = $request->header('Authorization', null);
        if (is_string($authorization)) {
            list($clientStr, $authStr) = explode(':', $authorization);
            list($classfication, $client) = explode(' ', $clientStr);
        }

        $logData = [
            'ip'      => $request->ip(),
            'client'  => $client,
            'uri'     => $request->path(),
            'header'  => $request->header(),
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
