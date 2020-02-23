<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Http\Controllers\V1\ApiResourceInterface;
use App\Service\Community\Article\DiscussionService;
use Illuminate\Http\Request;

class DiscussionController extends ApiControllerAbstract implements ApiResourceInterface
{
    public function listModel(Request $request)
    {
        $commentId = $request->input('comment_id');
        $discussionList = (new DiscussionService())->listModel($commentId);

        return $this->response(['list' => $discussionList]);
    }

    public function createModel(Request $request)
    {
        $commentId = $request->input('comment_id');
        $body = $request->input('body');
        $userId = config('client_id');
        $sDiscussion = new DiscussionService();
        $dbDiscussion = $sDiscussion->createModel($userId, $commentId, $body);
        $discussionList = $sDiscussion->listModel($commentId);

        return $this->response(['list' => $discussionList]);
    }

    public function showModel(Request $request, $id)
    {
    }

    public function editModel(Request $request, $id)
    {
    }

    public function updateModel(Request $request, $id)
    {
    }

    public function deleteModel(Request $request, $id)
    {
    }
}
