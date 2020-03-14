<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;

class ChannelAuth
{
    public function handle(Request $request, Closure $next)
    {
        $authorization = $request->header('authorization', '');
        if (is_string($authorization) && $authorization !== '') {
            list($clientStr, $authStr) = explode(':', $authorization);
            list($client, $clientId) = explode(' ', $clientStr);
            // Laravel 私有频道需要用到自带的 Auth 用户认证，所以在中间件里根据 Token 登录用户。
            \Auth::loginUsingId((int)$clientId);
            $response = $next($request);
        } else {
            $response = response('false', 400);
        }

        return $response;
    }
}
