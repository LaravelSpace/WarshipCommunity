<?php

namespace App\Http\Controllers\Community;


interface ResourceInterface
{
    public function dataHandler(array $inputData, string $classification);
}
