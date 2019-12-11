<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Http\Controllers\V1\ApiResourceInterface;
use App\Service\Community\Article\CommentService;
use Illuminate\Http\Request;

class CommentController extends ApiControllerAbstract implements ApiResourceInterface
{
    public function store(Request $request)
    {
        $articleId = $request->input('article_id');
        $body = $request->input('body');
        $user = ['id' => 4];

        $result = (new CommentService())->createComment($user, $articleId, $body);

        return $this->response(['comment_id' => $result]);
    }

    public function index(Request $request)
    {
        // TODO: Implement index() method.
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