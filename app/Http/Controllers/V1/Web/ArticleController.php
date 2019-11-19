<?php

namespace App\Http\Controllers\V1\Web;


use App\Http\Controllers\V1\WebResourceInterface;
use App\Http\Controllers\V1\WebControllerAbstract;
use Illuminate\Http\Request;

class ArticleController extends WebControllerAbstract implements WebResourceInterface
{
    public function store(Request $request)
    {
        return view('community.article.store');
    }

    public function index(Request $request)
    {
        return view('community.article.index');
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
