<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Http\Controllers\V1\ApiResourceInterface;
use App\Service\Community\Article\CommentService;
use Illuminate\Http\Request;

class CommentController extends ApiControllerAbstract
{
    public function listComment(Request $request)
    {
        $classification = $request->input('$classification');
        $targetId = $request->input('target_id');
        $page = (int)$request->input('page', 1);

        $result = (new CommentService())->listComment($classification, $targetId, $page);

        return $this->response($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function create(Request $request)
    {
        $articleId = $request->input('article_id');
        $body = $request->input('body');
        $userId = config('client_id');

        $result = (new CommentService())->createComment($userId, $articleId, $body);

        return $this->response(['comment_id' => $result]);
    }

    public function show(Request $request, $id)
    {
        // TODO: Implement show() method.
    }

    public function edit(Request $request, $id)
    {
        // TODO: Implement edit() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete(Request $request, $id)
    {
        // TODO: Implement destroy() method.
    }
}