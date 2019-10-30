<?php

namespace App\Http\Controllers\Test;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestSensitiveWordController extends Controller
{
    public function __construct()
    {
        if (!env('APP_DEBUG')) {
            abort(404);
        }
    }

    public function test(Request $request)
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
