<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    /**
     * TestController constructor.
     */
    public function __construct()
    {
        // 如果不是测试环境直接返回 404 页面
        if (!env('APP_DEBUG')) {
            abort(404);
        }
    }

    public function test()
    {
        $resultData = (new TestSensitiveWordController())->test();

        return response()->json($resultData);
    }
}
