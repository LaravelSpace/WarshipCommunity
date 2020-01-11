<?php

namespace App\Http\Controllers\Test;

use App\Service\Common\Image\Model\ImageModel;
use App\Service\Community\Article\Model\ArticleModel;
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
        return redirect('/');
    }
}
