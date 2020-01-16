<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\ArticleHandler;

class ArticleService
{
    public function listArticle(int $page = 1, int $perPage = 10)
    {
        return (new ArticleHandler())->listArticle($page, $perPage);
    }

    /**
     * @param int    $userId
     * @param string $title
     * @param string $body
     * @return int|mixed
     * @throws \App\Exceptions\ServiceException
     */
    public function createArticle(int $userId, string $title, string $body)
    {
        return (new ArticleHandler())->createArticle($userId, $title, $body);
    }

    /**
     * @param int  $id
     * @param bool $markdown
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
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

    public function listBookmark(array $user, int $page = 1)
    {

    }

    public function createBookmark(array $user, int $id)
    {

    }

    public function deleteBookmark(array $user, int $id)
    {

    }
}
