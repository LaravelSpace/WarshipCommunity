<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RequestThrottle
{
    public function handle(Request $request, Closure $next)
    {
        // 从 header 获取认证信息
        $authorization = $request->header('Authorization', null);
        if ($authorization !== null && is_string($authorization)) {
            list($clientStr, $authStr) = explode(':', $authorization);
            list($classfication, $clientId) = explode(' ', $clientStr);
        }

        $routeThrottle = config('constant.route_throttle');
        $limitField = $routeThrottle['field'];
        $limitTime = $routeThrottle['time'];
        if (isset($clientId) && is_string($clientId)) {
            $limitKey = $clientId;
            $limitGroup = $routeThrottle['client'];
        } else {
            $ip = $request->ip();
            $limitKey = md5($ip);
            $limitGroup = $routeThrottle['ip'];
        }

        // 检查 client 或者 ip 有没有达到频率限制
        $checkResult = true;
        foreach ($limitField as $item) {
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
