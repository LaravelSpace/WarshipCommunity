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
     * @param $userId         [评论 id]
     * @param $commentId      [评论 id]
     * @param $discussionBody [讨论内容]
     * @return \Illuminate\Database\Eloquent\Model [讨论实例]
     */
    public function createModel($userId, $commentId, $discussionBody)
    {
        return (new DiscussionHandler())->createModel($userId, $commentId, $discussionBody);
    }

    /**
     * @param $discussionId [讨论 id]
     * @return array [讨论实例]
     */
    public function getModel($discussionId)
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
