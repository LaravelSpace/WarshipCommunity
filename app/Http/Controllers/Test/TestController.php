<?php

namespace App\Http\Controllers\Test;

use App\Service\Common\Image\Model\ImageModel;
use App\Service\Common\SensitiveWord\SensitiveWordService;
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
        dd(storage_path('aaa'));
    }

    private function iTestSensitiveWord()
    {
        $checkString = '王八羔王八子啊王八羔子啊兔崽兔崽子王八蛋';
        $checkResult = (new SensitiveWordService('DFA'))->checkSensitiveWord($checkString);
        $returnData = [
            'controller'  => 'TestSensitiveWordController',
            'function'    => 'test',
            'checkResult' => $checkResult
        ];

        return $returnData;
    }
}
