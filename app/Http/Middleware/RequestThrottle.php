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
        $client = 'web_user';
        $clientId = 998;
        $authorization = $request->header('authorization', '');
        if (is_string($authorization && $authorization !== '')) {
            list($clientStr, $authStr) = explode(':', $authorization);
            list($client, $clientId) = explode(' ', $clientStr);
        }
        config(['client' => $client]);
        config(['client_id' => (int)$clientId]);

        $ip = $request->ip();
        $checkResult = $this->iCheckThrottle($ip, $clientId);
        if ($checkResult) {
            $response = $next($request);
        } else {
            $returnData = ['status' => 408, 'message' => '达到请求限制次数', 'data' => []];
            $response = response()->json($returnData, 408);
        }

        return $response;
    }

    /**
     * 检查 client 或者 ip 有没有达到频率限制
     *
     * @param string $ip
     * @param int    $clientId
     * @return bool
     */
    public function iCheckThrottle(string $ip, int $clientId)
    {
        $routeThrottle = config('constant.route_throttle');
        $limitField = $routeThrottle['field'];
        $limitTime = $routeThrottle['time'];
        if (isset($clientId) && is_numeric($clientId) && $clientId !== 988) {
            $limitKey = $clientId;
            $limitGroup = $routeThrottle['client'];
        } else {
            $limitKey = md5($ip);
            $limitGroup = $routeThrottle['ip'];
        }
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

        return $checkResult;
    }
}
