<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\CommentHandler;

class CommentService
{
    public function createComment(){}

    public function listComment(string $classification, int $id, int $page = 1)
    {
        return (new CommentHandler())->listComment($classification, $id, $page);
    }

    public function getComment(){}

    public function updateComment(){}

    public function deleteComment(){}
}