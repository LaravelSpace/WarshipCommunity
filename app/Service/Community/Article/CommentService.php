<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\CommentHandler;

class CommentService
{
    public function listComment(string $classification, int $id, int $page = 1, int $perPage = 5)
    {
        return (new CommentHandler())->listComment($classification, $id, $page, $perPage);
    }

    /**
     * @param int    $userId
     * @param string $articleId
     * @param string $body
     * @return int|mixed
     * @throws \App\Exceptions\ServiceException
     */
    public function createComment(int $userId, string $articleId, string $body)
    {
        return (new CommentHandler())->createComment($userId, $articleId, $body);
    }

    public function getComment()
    {
    }

    public function updateComment()
    {
    }

    public function deleteComment()
    {
    }
}
