<?php

namespace App\Http\Controllers\Community\Article;

use App\Community\Article\Service\ArticleService;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class ArticleController extends WebController
{
    public function getArticleList()
    {
        $service = new ArticleService();
        $articleList = $service->getArticleList();

        return $this->response($articleList);
    }
}
