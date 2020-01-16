<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Http\Controllers\V1\ApiResourceInterface;
use App\Service\Community\Article\CommentService;
use Illuminate\Http\Request;

class CommentController extends ApiControllerAbstract implements ApiResourceInterface
{
    public function index(Request $request)
    {
        // TODO: Implement index() method.
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function store(Request $request)
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

    public function destroy(Request $request, $id)
    {
        // TODO: Implement destroy() method.
    }
}