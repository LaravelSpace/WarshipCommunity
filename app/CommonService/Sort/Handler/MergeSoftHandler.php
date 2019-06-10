<?php

namespace App\CommonService\Sort\Handler;

/**
 * Class MergeSoftHandler
 * 归并排序(Merge-Sort) 时间复杂度=O(nlogn) 空间复杂度=T(n)
 *
 * @package App\CommonService\Sort\Handler
 */
class MergeSoftHandler
{
    private $sortArray;

    private $sortTimes;

    private $sortSteps;

    public function __construct(array $arrayData)
    {
        $this->sortArray = $arrayData;
        $this->sortTimes = 0;
        $this->sortSteps = [];
        $this->sortSteps[] = json_encode($this->sortArray);
    }

    public function sort()
    {
        $startIndex = 0;
        $endIndex = count($this->sortArray) - 1;
        $this->iSort($this->sortArray, $startIndex, $endIndex);

        return [
            'sortArray' => $this->sortArray,
            'sortTimes' => $this->sortTimes,
            'sortSteps' => $this->sortSteps,
        ];
    }

    private function iSort(array &$sortArray, int $startIndex, int $endIndex)
    {
        $this->sortTimes++;
        if ($startIndex < $endIndex) {
            $middleIndex = (int)floor(($startIndex + $endIndex) / 2);
            $this->iSort($sortArray, $startIndex, $middleIndex);
            $this->iSort($sortArray, $middleIndex + 1, $endIndex);
            $this->iMerge($sortArray, $startIndex, $middleIndex, $endIndex);
        }
    }

    private function iMerge(array &$sortArray, int $startIndex, int $middleIndex, int $endIndex)
    {
        $i = $startIndex;
        $j = $middleIndex + 1;
        $k = $startIndex;
        $tempArray = [];
        while ($i !== $middleIndex + 1 && $j !== $endIndex + 1) {
            if ($sortArray[$i] >= $sortArray[$j]) {
                $tempArray[$k++] = $sortArray[$j++];
            } else {
                $tempArray[$k++] = $sortArray[$i++];
            }
        }
        while ($i !== $middleIndex + 1) {
            $tempArray[$k++] = $sortArray[$i++];
        }
        while ($j !== $endIndex + 1) {
            $tempArray[$k++] = $sortArray[$j++];
        }
        for ($i = $startIndex; $i <= $endIndex; $i++) {
            $sortArray[$i] = $tempArray[$i];
        }
        $this->sortSteps[] = json_encode($this->sortArray);
    }
}
