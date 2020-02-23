<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Http\Controllers\V1\ApiResourceInterface;
use App\Service\Community\Article\CommentService;
use Illuminate\Http\Request;

class CommentController extends ApiControllerAbstract implements ApiResourceInterface
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listModel(Request $request)
    {
        $classification = $request->input('classification');
        $targetId = $request->input('target_id');
        $withDiscussion = (bool)$request->input('with_discussion', false);
        $page = (int)$request->input('page', 1);

        $result = (new CommentService())->listModel($classification, $targetId,$withDiscussion, $page);

        return $this->response($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function createModel(Request $request)
    {
        $articleId = $request->input('article_id');
        $body = $request->input('body');
        $userId = config('client_id');

        $result = (new CommentService())->createModel($userId, $articleId, $body);

        return $this->response(['comment_id' => $result]);
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