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
        $input = $request->all();
        $result = (new ArticleService())->getArticleList();

        return $this->response($result);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $title = $input['title'];
        $body = $input['body'];
        $user = ['id'=>4];

        (new ArticleService())->createArticle($user,$title,$body);
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
