<?php

namespace App\Http\Controllers\V1\Web;

use App\Http\Controllers\V1\WebController;

class IndexController extends WebController
{
    public function index()
    {
        return view('community.index');
    }
}
