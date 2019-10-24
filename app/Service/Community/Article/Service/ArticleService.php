<?php

namespace App\Service\Community\Article\Service;


use App\Service\Community\Article\Handler\ArticleHandler;

class ArticleService
{
    public function getArticleList()
    {
        return (new ArticleHandler())->getArticleList();
    }

    public function createArticle(array $user,string $title,string $body)
    {
        return (new ArticleHandler())->createArticle($user,$title,$body);
    }
}
