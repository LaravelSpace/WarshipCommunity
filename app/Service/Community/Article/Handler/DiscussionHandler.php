<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\CheckSensitiveEvent;
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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createModel($userId, $commentId, $discussionBody)
    {
        $createField = [
            'body'       => $discussionBody,
            'user_id'    => $userId,
            'comment_id' => $commentId,
        ];
        $dbDiscussion = DiscussionModel::create($createField);
        $classification = config('constant.classification.discussion');
        event(new CheckSensitiveEvent($classification, $dbDiscussion->id));

        return $dbDiscussion;
    }

    /**
     * @param $targetId
     * @return array
     */
    public function getModel($targetId)
    {
        return DiscussionModel::findOrFail($targetId)->toArray();
    }
}
