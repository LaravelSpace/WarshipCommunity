<?php

namespace App\Community\Article\Repository;


use App\Community\Article\Model\Article;

class ArticleRepository
{
    /**
     * 获取文章列表
     *
     * @return array
     */
    public function articleList()
    {
        return Article::with('user')->get()->toArray();
    }
}
