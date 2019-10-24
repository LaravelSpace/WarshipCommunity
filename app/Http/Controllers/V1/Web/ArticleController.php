<?php

namespace App\Http\Controllers\V1\Web;


use App\Http\Controllers\V1\ResourceWebInterface;
use App\Http\Controllers\V1\WebController;
use Illuminate\Http\Request;

class ArticleController extends WebController implements ResourceWebInterface
{
    public function index(Request $request)
    {
        return view('community.article.index');
    }

    public function create(Request $request)
    {
        return view('community.article.create');
    }

    public function show(Request $request)
    {
        return view('community.article.show');
    }

    public function edit(Request $request)
    {
        return view('community.article.edit');
    }
}
