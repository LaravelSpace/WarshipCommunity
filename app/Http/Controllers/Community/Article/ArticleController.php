<?php

namespace App\Http\Controllers\Community\Article;

use App\Community\Article\Service\ArticleService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function getArticleList()
    {
        $service = new ArticleService();

        $articleList = $service->getArticleList();

        return response()->json([
            'status'  => 200,
            'message' => 'success',
            'data'    => $articleList,
        ]);
    }
}
