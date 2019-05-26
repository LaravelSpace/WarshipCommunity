<?php

namespace App\Http\Controllers\Community;

use App\Community\Article\Service\ArticleService;
use App\Exceptions\ValidateException;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class ArticleController extends WebController
{
    public function articlePage(Request $request, $id = 0)
    {
        $inputData = $request->all();
        $target = (isset($inputData['target'])) ? $inputData['target'] : '';
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

    public function articleList(Request $request)
    {
        $inputData = $request->all();

        return $this->articleData($inputData, 'articleList');
    }

    public function article(Request $request, $id = 0)
    {
        $inputData = $request->all();
        $inputData['article_id'] = $id;
        $httpMethod = $request->getMethod();
        $httpMethod = strtoupper($httpMethod);

        if ($httpMethod === config('constant.post')) {
            return $this->articleData($inputData, 'articleCreate');
        } else if ($httpMethod === config('constant.get')) {
            return $this->articleData($inputData, 'articleSelect');
        } else if ($httpMethod === config('constant.put')) {
            return $this->articleData($inputData, 'articleUpdate');
        } else if ($httpMethod === config('constant.delete')) {
            return $this->articleData($inputData, 'articleDelete');
        } else {
            return $this->articleData($inputData, 'articleSelect');
        }
    }

    public function articleData(array $inputData, $classification = '', $id = 0)
    {
        $service = new ArticleService();
        try {
            $resultData = $service->article($inputData, $classification);

            return $this->response($resultData);
        } catch (ValidateException $exception) {
            return $this->setStatusCode($exception->getCode())
                ->responseError($exception->getCode(), $exception->getMessage());
        }
    }
}
