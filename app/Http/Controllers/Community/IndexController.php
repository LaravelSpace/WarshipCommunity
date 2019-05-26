<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class IndexController extends WebController
{
    public function index()
    {
        return view('community.index.index');
    }
}
