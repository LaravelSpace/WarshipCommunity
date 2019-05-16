<?php

namespace App\Http\Controllers\Test;


use App\SystemHelper\SensitiveWord\Service\SensitiveWordService;

class TestSensitiveWordController
{
    public function test()
    {
        $checkString = '王八羔王八子啊王八羔子啊兔崽兔崽子王八蛋';
        $checkResult = (new SensitiveWordService('DFA'))->checkSensitiveWord($checkString);
        $returnData = [
            'controller'  => 'TestSensitiveWordController',
            'function'    => 'test',
            'checkResult' => $checkResult,
        ];

        return $returnData;
    }
}
