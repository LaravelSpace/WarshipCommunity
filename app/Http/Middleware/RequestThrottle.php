<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Cache;

class RequestThrottle
{
    public function handle($request, Closure $next)
    {
        $authorization = $request->header('Authorization', null);
        if (is_string($authorization)) {
            list($clientStr, $authStr) = explode(':', $authorization);
            list($classfication, $client) = explode(' ', $clientStr);
        }

        $limitConfirm = config('constant.route_throttle');
        if (isset($client) && is_string($client)) {
            $limitKey = $client;
            $limitGroup = $limitConfirm['client'];
        } else {
            $ip = $request->ip();
            $limitKey = md5($ip);
            $limitGroup = $limitConfirm['ip'];
        }
        $limitTime = $limitConfirm['time'];

        $checkField = $limitConfirm['field'];
        $checkResult = true;
        foreach ($checkField as $item) {
            $cacheKey = $limitKey . '_' . $item;
            if (!Cache::has($cacheKey)) {
                Cache::put($cacheKey, 1, $limitTime[$item]);
                continue;
            }
            $limit = Cache::get($cacheKey, 1);
            if ($limit < $limitGroup[$item]) {
                Cache::increment($cacheKey);
                continue;
            }
            $checkResult = false;
        }

        if ($checkResult) {
            $response = $next($request);
        } else {
            $returnData = ['status' => 408, 'message' => '达到请求限制次数', 'data' => []];
            $response = response()->json($returnData, 408);
        }

        return $response;
    }
}
