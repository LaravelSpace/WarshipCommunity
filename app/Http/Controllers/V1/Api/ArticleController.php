<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiController;
use App\Http\Controllers\V1\ResourceApiInterface;
use App\Service\Community\Article\Service\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends ApiController implements ResourceApiInterface
{
    public function index(Request $request)
    {
        $page = (int)$request->input('page',1);

        $result = (new ArticleService())->getArticleList($page);

        return $this->response($result);
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $user = ['id' => 4];

        (new ArticleService())->createArticle($user, $title, $body);
    }

    public function show(Request $request, $id)
    {
        (new ArticleService())->getArticle();
    }

    public function edit(Request $request)
    {
        (new ArticleService())->getArticle();
    }

    public function update(Request $request)
    {
        (new ArticleService())->updateArticle();
    }

    public function destroy(Request $request)
    {
        (new ArticleService())->deleteArticle();
    }
}
