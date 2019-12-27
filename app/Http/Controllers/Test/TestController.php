<?php

namespace App\Http\Controllers\Test;

use App\Service\Community\Article\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        dd("\u4eba\u5728\u65c5\u9014\uff0c\u96be\u514d\u8ff7\u8def\uff0c\u597d\u5728\u4f60\u6709\u643a\u7a0b\u3002");

        return redirect('/');
    }
}
