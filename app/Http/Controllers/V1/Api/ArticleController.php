<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Http\Controllers\V1\ApiResourceInterface;
use App\Service\Community\Article\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends ApiControllerAbstract implements ApiResourceInterface
{
    public function listModel(Request $request)
    {
        $page = (int)$request->input('page', 1);
        $result = (new ArticleService())->listModel($page);

        return $this->response($result);
    }

    public function createModel(Request $request)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $userId = config('client_id');
        $dbArticle = (new ArticleService())->createModel($userId, $title, $body);

        return $this->response(['article_id' => $dbArticle->id]);
    }

    public function showModel(Request $request, $id)
    {
        $result = (new ArticleService())->getModel($id, true);

        return $this->response($result);
    }

    public function editModel(Request $request, $id)
    {
        $result = (new ArticleService())->getModel($id);

        return $this->response($result);
    }

    public function updateModel(Request $request, $id)
    {
        $title = $request->input('title');
        $body = $request->input('body');
        $result = (new ArticleService())->updateModel($id, $title, $body);

        return $this->response(['article_id' => $result]);
    }

    public function deleteModel(Request $request, $id)
    {
        $result = (new ArticleService())->deleteModel($id);

        return $this->response(['article_id' => $result]);
    }
}
