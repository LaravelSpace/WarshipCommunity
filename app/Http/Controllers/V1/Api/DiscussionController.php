<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Service\Community\Article\DiscussionService;
use Illuminate\Http\Request;

class DiscussionController extends ApiControllerAbstract
{
    public function create(Request $request)
    {
        $userId = config('client_id');
        $commentId = $request->input('comment_id');
        $body = $request->input('body');
        $dbDiscussion = (new DiscussionService())->create($userId, $commentId, $body);

        return $this->response(['discussion_id' => $dbDiscussion->id]);
    }

    public function listDiscussion(Request $request){
        $commentId = $request->input('comment_id');

        $discussionList = (new DiscussionService())->listDiscussion($commentId);

        return $this->response(['list' => $discussionList]);
    }
}
