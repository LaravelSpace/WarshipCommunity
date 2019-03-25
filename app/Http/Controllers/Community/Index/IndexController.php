<?php

namespace App\Http\Controllers\Community\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('community.index.index');
    }
}
