<?php

namespace App\Http\Controllers\Test;


use App\AlgorithmDemo\Sort\Handler\BubbleSortHandler;
use App\AlgorithmDemo\Sort\Handler\InsertionSortHandler;
use App\AlgorithmDemo\Sort\Handler\MergeSortHandler;
use App\AlgorithmDemo\Sort\Handler\QuickSortHandler;
use App\AlgorithmDemo\Sort\Handler\SelectionSortHandler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestSortController extends Controller
{
    public function __construct()
    {
        if (!env('APP_DEBUG')) {
            abort(404);
        }
    }

    public function sort(Request $request)
    {
        $arrayData = [];
        $arrayNum = 8;
        for ($i = 0; $i < $arrayNum; $i++) {
            $arrayData[] = rand(1, 20);
        }

        $bubbleSortResult = (new BubbleSortHandler($arrayData))->sort();
        $mergeSortResult = (new MergeSortHandler($arrayData))->sort();
        $quickSortResult = (new QuickSortHandler($arrayData))->sort();
        $selectionSortResult = (new SelectionSortHandler($arrayData))->sort();
        $insertionSortResult = (new InsertionSortHandler($arrayData))->sort();

        $returnData = [
            'basicData'           => [
                'arrayData' => $arrayData,
                'arrayNum'  => $arrayNum,
            ],
            'bubbleSort'          => $bubbleSortResult,
            'mergeSort'           => $mergeSortResult,
            'quickSort'           => $quickSortResult,
            'selectionSortResult' => $selectionSortResult,
            'insertionSortResult' => $insertionSortResult,
        ];

        return response()->json($returnData);
    }
}
