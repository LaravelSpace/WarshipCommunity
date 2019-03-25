<?php

namespace App\Community\Article\Service;


use App\Community\Article\Model\Article;

class ArticleService
{
    /**
     * @return array
     */
    public function getArticleList()
    {
        return Article::with('user')->get()->toArray();
    }
}