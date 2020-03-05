<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\DiscussionHandler;

class DiscussionService
{
    /**
     * @param int $commentId [评论 id]
     * @return array [讨论列表]
     */
    public function listModel(int $commentId)
    {
        return (new DiscussionHandler())->listDiscussion($commentId);
    }

    /**
     * @param int    $userId         [评论 id]
     * @param int    $commentId      [评论 id]
     * @param string $discussionBody [讨论内容]
     * @return \Illuminate\Database\Eloquent\Model [讨论实例]
     */
    public function createModel(int $userId, int $commentId, string $discussionBody)
    {
        return (new DiscussionHandler())->createModel($userId, $commentId, $discussionBody);
    }

    /**
     * @param int $discussionId [讨论 id]
     * @return array [讨论实例]
     */
    public function getModel(int $discussionId)
    {
        return (new DiscussionHandler())->getModel($discussionId);
    }

    public function updateModel()
    {
    }

    public function deleteModel()
    {
    }
}
