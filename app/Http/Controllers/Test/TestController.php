<?php

namespace App\Http\Controllers\Test;

use App\Events\Community\CheckSensitiveEvent;
use App\Service\Common\SensitiveWord\SensitiveWordService;
use App\Service\User\UserService;
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
        // broadcast(new \App\Events\Community\NotificationEvent());

        // (new UserService())->markSignCalendar(11);
        // (new UserService())->getSignCalendar(11);
    }

    private function iTestStoragePath()
    {
        dd(storage_path('logs'));
    }

    private function iTestSensitiveByStr()
    {
        $checkString = '王八羔王八子啊王八羔子啊兔崽兔崽子王八蛋';
        $checkResult = (new SensitiveWordService('DFA'))->checkSensitiveByStr($checkString);
        $returnData = [
            'controller'  => 'TestController',
            'function'    => 'iTestSensitiveByStr',
            'checkResult' => $checkResult
        ];

        return $returnData;
    }

    private function iTestSensitiveByModel()
    {
        // $classification = config('constant.classification.article');
        // $classification = config('constant.classification.comment');
        $classification = config('constant.classification.discussion');
        event(new CheckSensitiveEvent($classification, 4));
    }
}
