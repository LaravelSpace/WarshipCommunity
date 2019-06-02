<?php

namespace App\Community\Article\Repository;


use App\Community\Article\Model\Article;

class ArticleRepository
{
    public function articleItem(int $articleId)
    {
        return Article::find($articleId);
    }

    public function articleList()
    {
        return Article::all();
    }
}
