<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\DiscussionHandler;

class DiscussionService
{
    /**
     * @param int $commentId [评论 id]
     * @return array
     */
    public function listModel(int $commentId)
    {
        return (new DiscussionHandler())->listDiscussion($commentId);
    }

    /**
     * @param $userId
     * @param $commentId
     * @param $discussionBody
     * @return Model\DiscussionModel
     */
    public function createModel($userId, $commentId, $discussionBody)
    {
        return (new DiscussionHandler())->createModel($userId, $commentId, $discussionBody);
    }
}
