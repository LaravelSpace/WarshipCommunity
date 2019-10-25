<?php

namespace App\Http\Controllers\V1;


use App\Http\Controllers\Controller;

abstract class ApiController extends Controller
{
    use ControllerHelper;

    public function __construct()
    {
        $this->httpStatusCode = config('constant.HTTP_STATUS_CODE');
    }
}
