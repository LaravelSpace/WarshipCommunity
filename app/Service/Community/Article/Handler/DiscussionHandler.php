<?php

namespace App\Service\Community\Article\Handler;


use App\Service\Community\Article\Model\DiscussionModel;

class DiscussionHandler
{
    /**
     * @param int $commentId
     * @return array
     */
    public function listDiscussion(int $commentId)
    {
        $whereField = ['comment_id' => $commentId];
        $discussionList = DiscussionModel::where($whereField)->passExamine()->notInBlacklist()
            ->with('user:id,name')->latest()->limit(10)->get()->toArray();

        return $discussionList;
    }

    /**
     * @param $userId
     * @param $commentId
     * @param $discussionBody
     * @return DiscussionModel
     */
    public function createModel($userId, $commentId, $discussionBody)
    {
        $createField = [
            'body'       => $discussionBody,
            'user_id'    => $userId,
            'comment_id' => $commentId,
        ];
        $dbDiscussion = DiscussionModel::create($createField);

        return $dbDiscussion;
    }
}
