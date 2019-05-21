<?php

namespace App\Http\Controllers\Community\Article;

use App\Community\Article\Service\ArticleService;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class ArticleController extends WebController
{
    public function articlePage(Request $request)
    {
        $inputData = $request->all();
        if (!isset($inputData['target'])) {
            return view('community.article.index');
        } else {
            $target = $inputData['target'];
        }
        switch ($target) {
            case 'create';
                return view('community.article.create');
                break;
            case 'update';
                return view('community.article.update');
                break;
            default:
                return view('community.article.index');
        }
    }

    public function articleData(Request $request, $id = 0, $classification = '')
    {

    }

    public function getArticleList()
    {
        $service = new ArticleService();
        $articleList = $service->getArticleList();

        return $this->response($articleList);
    }
}
