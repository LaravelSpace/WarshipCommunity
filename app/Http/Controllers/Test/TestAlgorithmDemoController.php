<?php

namespace App\Http\Controllers\Test;


use App\AlgorithmDemo\DynamicProgramming\Handler\ClimbingStepsHandler;
use App\AlgorithmDemo\Sort\Handler\BubbleSortHandler;
use App\AlgorithmDemo\Sort\Handler\InsertionSortHandler;
use App\AlgorithmDemo\Sort\Handler\MergeSortHandler;
use App\AlgorithmDemo\Sort\Handler\QuickSortHandler;
use App\AlgorithmDemo\Sort\Handler\SelectionSortHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestAlgorithmDemoController extends Controller
{
    public function __construct()
    {
        if (!env('APP_DEBUG')) {
            abort(404);
        }
    }

    public function climbingSteps(Request $request)
    {
        $steps = 5;

        $handlerRecursionOnly = new ClimbingStepsHandler();
        $resultRecursionOnly = $handlerRecursionOnly->recursionOnly($steps);

        $handlerRecursionByStorage = new ClimbingStepsHandler();
        $resultRecursionByStorage = $handlerRecursionByStorage->recursionByStorage($steps);

        $handlerDynamicProgramming = new ClimbingStepsHandler();
        $resultDynamicProgramming = $handlerDynamicProgramming->dynamicProgramming($steps);

        $returnData = [
            'recursionOnly'      => [
                'resultNum'   => $resultRecursionOnly,
                'handleSteps' => $handlerRecursionOnly->getHandleSteps()
            ],
            'recursionByStorage' => [
                'resultNum'   => $resultRecursionByStorage,
                'handleSteps' => $handlerRecursionByStorage->getHandleSteps()
            ],
            'dynamicProgramming' => [
                'resultNum' => $resultDynamicProgramming,
            ]
        ];

        return response()->json($returnData);
    }

    public function sort(Request $request)
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
            'basicData'           => [
                'arrayData' => $arrayData,
                'arrayNum'  => $arrayNum,
            ],
            // 'bubbleSort' => $bubbleSortResult,
            // 'mergeSort'  => $mergeSortResult,
            // 'quickSort'  => $quickSortResult,
            // 'selectionSortResult'=>$selectionSortResult,
            'insertionSortResult' => $insertionSortResult,
        ];

        return response()->json($returnData);
    }
}
