<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\ArticleHandler;

class ArticleService
{
    public function createArticle(array $user, string $title, string $body)
    {
        return (new ArticleHandler())->createArticle($user, $title, $body);
    }

    public function getArticleList(int $page = 1)
    {
        return (new ArticleHandler())->getArticleList($page);
    }

    public function getArticle(int $id, bool $markdown = false)
    {
        return (new ArticleHandler())->getArticle($id, $markdown);
    }

    public function updateArticle(int $id, string $title, string $body)
    {
        return (new ArticleHandler())->updateArticle($id, $title, $body);
    }

    public function deleteArticle(int $id)
    {
        return (new ArticleHandler())->deleteArticle($id);
    }
}
