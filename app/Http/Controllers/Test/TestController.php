<?php

namespace App\Http\Controllers\Test;

use App\Jobs\Common\SensitiveWordJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ReflectionClass;

class TestController extends Controller
{
    public function __construct()
    {
        if (!env('APP_DEBUG')) {
            abort(404); // 如果不是测试环境直接返回 404 页面
        }
    }

    public function test(Request $request)
    {
        SensitiveWordJob::dispatch()->onQueue('sensitive');

        return response()->json([1]);
    }
}
