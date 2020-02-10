<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Http\Controllers\V1\ApiResourceInterface;
use App\Service\Community\Article\ArticleService;
use App\Service\Community\Article\CommentService;
use Illuminate\Http\Request;

class ArticleController extends ApiControllerAbstract
{
    public function listArticle(Request $request)
    {
        $page = (int)$request->input('page', 1);
        $result = (new ArticleService())->listArticle($page);

        return $this->response($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function create(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $userId = config('client_id');

        $result = (new ArticleService())->createArticle($userId, $title, $body);

        return $this->response(['article_id' => $result]);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function show(Request $request, $id)
    {
        $result = (new ArticleService())->getArticle($id, true);

        return $this->response($result);
    }

    /**
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ServiceException
     */
    public function edit(Request $request, $id)
    {
        $result = (new ArticleService())->getArticle($id);

        return $this->response($result);
    }

    public function update(Request $request, $id)
    {
        $title = $request->input('title');
        $body = $request->input('body');

        $result = (new ArticleService())->updateArticle($id, $title, $body);

        return $this->response(['article_id' => $result]);
    }

    public function delete(Request $request, $id)
    {
        $result = (new ArticleService())->deleteArticle($id);

        return $this->response(['article_id' => $result]);
    }
}
