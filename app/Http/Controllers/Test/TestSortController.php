<?php

namespace App\Http\Controllers\Test;


use App\CommonService\Sort\Handler\MergeSoftHandler;
use Illuminate\Http\Request;

class TestSortController extends TestController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test(Request $request)
    {
        $arrayData = [];
        $arrayNum = 8;
        for ($i = 0; $i < $arrayNum; $i++) {
            $arrayData[] = rand(1, 20);
        }

        $mergeSortData = (new MergeSoftHandler($arrayData))->sort();

        $returnData = [
            'basicData' => [
                'arrayData' => $arrayData,
                'arrayNum'  => $arrayNum,
            ],
            'mergeSort' => $mergeSortData
        ];

        return response()->json($returnData);
    }
}
