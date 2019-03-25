<?php

namespace App\Http\Controllers\Test;

use App\SystemHelper\SensitiveWord\Service\SensitiveWordService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        if (!env('APP_DEBUG')) {
            return redirect('/');
        }

        $checkString = '王八羔子啊啊兔崽子王八蛋';
        // $sensitiveWordMap = (new SensitiveWordService())->getSensitiveWordMapByDFA();
        $sensitiveWordMap = (new SensitiveWordService())->checkSensitiveWordByDFA($checkString);

        $responseData = [$sensitiveWordMap];

        return response()->json([
            'controller' => 'TestController',
            'function'   => 'test',
            'data'       => $responseData,
        ]);
    }
}
