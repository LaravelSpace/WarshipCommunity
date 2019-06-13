<?php

namespace App\Http\Controllers\Test;


use App\CommonService\Sort\Handler\BubbleSortHandler;
use App\CommonService\Sort\Handler\InsertionSortHandler;
use App\CommonService\Sort\Handler\MergeSortHandler;
use App\CommonService\Sort\Handler\QuickSortHandler;
use App\CommonService\Sort\Handler\SelectionSortHandler;
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

        // $bubbleSortResult = (new BubbleSortHandler($arrayData))->sort();
        // $mergeSortResult = (new MergeSortHandler($arrayData))->sort();
        // $quickSortResult = (new QuickSortHandler($arrayData))->sort();
        // $selectionSortResult = (new SelectionSortHandler($arrayData))->sort();
        $insertionSortResult = (new InsertionSortHandler($arrayData))->sort();

        $returnData = [
            'basicData'  => [
                'arrayData' => $arrayData,
                'arrayNum'  => $arrayNum,
            ],
            // 'bubbleSort' => $bubbleSortResult,
            // 'mergeSort'  => $mergeSortResult,
            // 'quickSort'  => $quickSortResult,
            // 'selectionSortResult'=>$selectionSortResult,
            'insertionSortResult'=>$insertionSortResult,
        ];

        return response()->json($returnData);
    }
}
