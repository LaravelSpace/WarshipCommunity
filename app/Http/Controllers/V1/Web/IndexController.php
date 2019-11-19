<?php

namespace App\Http\Controllers\V1\Web;

use App\Http\Controllers\V1\WebControllerAbstract;

class IndexController extends WebControllerAbstract
{
    public function index()
    {
        return view('community.index');
    }
}
