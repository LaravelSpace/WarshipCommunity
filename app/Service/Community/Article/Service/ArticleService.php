<?php

namespace App\Service\Community\Article\Service;


use App\Service\Community\Article\Handler\ArticleHandler;

class ArticleService
{
    public function getArticleList(int $page = 1)
    {
        return (new ArticleHandler())->getArticleList($page);
    }

    public function createArticle(array $user, string $title, string $body)
    {
        return (new ArticleHandler())->createArticle($user, $title, $body);
    }
}
