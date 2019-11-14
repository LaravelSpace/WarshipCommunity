<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiController;
use App\Http\Controllers\V1\ResourceApiInterface;
use App\Service\Community\Article\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends ApiController implements ResourceApiInterface
{
    public function store(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $user = ['id' => 4];

        $result = (new ArticleService())->createArticle($user, $title, $body);

        return $this->response(['article_id' => $result]);
    }

    public function index(Request $request)
    {
        $page = (int)$request->input('page', 1);

        $result = (new ArticleService())->getArticleList($page);

        return $this->response($result);
    }

    public function show(Request $request, $id)
    {
        $result = (new ArticleService())->getArticle($id, true);

        return $this->response($result);
    }

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

    public function destroy(Request $request, $id)
    {
        $result = (new ArticleService())->deleteArticle($id);

        return $this->response(['article_id' => $result]);
    }

    public function comment(Request $request, $id)
    {
        $page = (int)$request->input('page', 1);

        $result = (new ArticleService())->getCommentList($id);

        return $this->response($result);
    }
}
