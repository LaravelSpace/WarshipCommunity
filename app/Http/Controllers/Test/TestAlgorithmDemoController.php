<?php

namespace App\Http\Controllers\Test;


use App\AlgorithmDemo\DynamicProgramming\Handler\ClimbingStepsHandler;
use App\AlgorithmDemo\DynamicProgramming\Handler\GiveChangeHandler;
use App\AlgorithmDemo\DynamicProgramming\Handler\KingAndGoldMineHandler;
use App\AlgorithmDemo\DynamicProgramming\Handler\LongestCommonSequenceHandler;
use App\AlgorithmDemo\DynamicProgramming\Handler\MinimumPathHandler;
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

    public function kingAndGoldMine(Request $request)
    {
        $goldMine = ['400-5', '500-5', '200-3', '300-4', '350-3'];
        $workerNumber = 10;

        $handlerDynamicProgramming = new KingAndGoldMineHandler();

        $returnData = [
            'goldMine'           => $goldMine,
            'workerNumber'       => $workerNumber,
            'dynamicProgramming' => [
                'maxGold' => $handlerDynamicProgramming->dynamicProgramming($goldMine, $workerNumber)
            ]
        ];

        return response()->json($returnData);
    }

    public function longestCommonSequence(Request $request)
    {
        $string1 = '1A2C3';
        $string2 = 'B1D23';

        $handlerDynamicProgramming = new LongestCommonSequenceHandler();

        $returnData = [
            'string1'            => $string1,
            'string2'            => $string2,
            'dynamicProgramming' => [
                'strLCS' => $handlerDynamicProgramming->dynamicProgramming($string1, $string2)
            ]
        ];

        return response()->json($returnData);
    }

    public function giveChange(Request $request)
    {
        $penny = [1, 2, 3];
        $aim = 3;

        $handlerRecursionOnly = new GiveChangeHandler();
        $handlerRecursionByStorage = new GiveChangeHandler();
        $handlerDynamicProgramming = new GiveChangeHandler();

        $returnData = [
            'penny'              => $penny,
            'aim'                => $aim,
            'recursionOnly'      => [
                'resultNum'   => $handlerRecursionOnly->recursionOnly($penny, 0, $aim),
                'handleSteps' => $handlerRecursionOnly->getHandleSteps()
            ],
            'recursionByStorage' => [
                'resultNum'    => $handlerRecursionByStorage->recursionByStorage($penny, 0, $aim),
                'handleSteps'  => $handlerRecursionByStorage->getHandleSteps(),
                'handleResult' => $handlerRecursionByStorage->getHandleResult()
            ],
            'dynamicProgramming' => [
                'resultNum' => $handlerDynamicProgramming->dynamicProgramming($penny, count($penny), $aim)
            ]
        ];

        return response()->json($returnData);
    }

    public function minimumPath(Request $request)
    {
        $row = 3;
        $column = 3;
        $matrix = [];
        for ($i = 0; $i < $row; $i++) {
            for ($j = 0; $j < $column; $j++) {
                $matrix[$i][$j] = rand(1, 20);
            }
        }
        $handlerRecursionOnly = new MinimumPathHandler($matrix, $row, $column);
        $handlerRecursionByStorage = new MinimumPathHandler($matrix, $row, $column);
        $handlerDynamicProgramming = new MinimumPathHandler($matrix, $row, $column);

        $m = 3;
        $n = 3;
        $returnData = [
            'matrix'             => $handlerRecursionOnly->getMatrix(),
            'recursionOnly'      => [
                'resultNum'   => $handlerRecursionOnly->recursionOnly($m, $n),
                'handleSteps' => $handlerRecursionOnly->getHandleSteps()
            ],
            'recursionByStorage' => [
                'resultNum'    => $handlerRecursionByStorage->recursionByStorage($m, $n),
                'handleSteps'  => $handlerRecursionByStorage->getHandleSteps(),
                'handleResult' => $handlerRecursionByStorage->getHandleResult()
            ],
            'dynamicProgramming' => [
                'resultNum' => $handlerDynamicProgramming->dynamicProgramming($m, $n)
            ]
        ];

        return response()->json($returnData);
    }

    public function climbingSteps(Request $request)
    {
        $steps = 5;
        $handlerRecursionOnly = new ClimbingStepsHandler();
        $handlerRecursionByStorage = new ClimbingStepsHandler();
        $handlerDynamicProgramming = new ClimbingStepsHandler();

        $returnData = [
            'recursionOnly'      => [
                'resultNum'   => $handlerRecursionOnly->recursionOnly($steps),
                'handleSteps' => $handlerRecursionOnly->getHandleSteps()
            ],
            'recursionByStorage' => [
                'resultNum'    => $handlerRecursionByStorage->recursionByStorage($steps),
                'handleSteps'  => $handlerRecursionByStorage->getHandleSteps(),
                'handleResult' => $handlerRecursionByStorage->getHandleResult()
            ],
            'dynamicProgramming' => [
                'resultNum' => $handlerDynamicProgramming->dynamicProgramming($steps)
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