<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Model\DiscussionModel;

class DiscussionService
{
    /**
     * @param $userId
     * @param $commentId
     * @param $body
     * @return DiscussionModel
     */
    public function create($userId, $commentId, $body)
    {
        $createField = [
            'body'       => $body,
            'user_id'    => $userId,
            'comment_id' => $commentId,
        ];
        $dbDiscussion = DiscussionModel::create($createField);

        return $dbDiscussion;
    }

    public function listDiscussion($commentId){
        $whereField = ['comment_id'=>$commentId];
        $discussionList = DiscussionModel::passExamine()->notInBlacklist()->where($whereField)->latest()->get();
        return $discussionList;
    }
}
