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
        $dbArticleList = Article::query()->passExamine()->notInBlacklist()->with('user')->simplePaginate(10);

        dd($dbArticleList);

        return redirect('/');
    }
}
