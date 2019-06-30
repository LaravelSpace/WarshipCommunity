<?php

namespace App\Http\Controllers\Test;


use App\CommonService\SensitiveWord\Service\SensitiveWordService;
use Illuminate\Http\Request;

class TestSensitiveWordController extends TestController
{
    public function __construct()
    {
        parent::__construct();
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
