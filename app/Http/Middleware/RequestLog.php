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

        $client = 'web_user';
        $clientId = 'web_user';
        $authorization = $request->header('Authorization', null);
        if ($authorization !== null && is_string($authorization)) {
            list($clientStr, $authStr) = explode(':', $authorization);
            list($classfication, $clientId) = explode(' ', $clientStr);
        }

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

        $logData = [
            'response' => $response->getContent(),
            'time'     => timeNow()
        ];
        event(new RequestLogEvent($logKey, $logData));

        return $response;
    }
}
