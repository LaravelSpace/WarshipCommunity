<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\CommentHandler;

class CommentService
{
    public function getCommentList(string $classification, int $id, int $page = 1)
    {
        return (new CommentHandler())->getCommentList($classification, $id, $page);
    }
}
