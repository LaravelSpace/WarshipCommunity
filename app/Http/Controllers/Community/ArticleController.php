<?php

namespace App\Http\Controllers\Community;


use App\Community\Article\Service\ArticleService;
use App\Exceptions\ValidateException;
use App\Http\Controllers\ResourceInterface;
use App\Http\Controllers\WebController;
use Illuminate\Http\Request;

class ArticleController extends WebController implements ResourceInterface
{
    public function index(Request $request)
    {
        $inputData = $request->all();
        if (isset($inputData['data']) && $inputData['data'] === '1') {
            return $this->dataHandler($inputData, 'articleList');
        } else {
            return view('community.article.index');
        }
    }

    public function create(Request $request)
    {
        return view('community.article.create');
    }

    public function store(Request $request)
    {
        $inputData = $request->all();

        return $this->dataHandler($inputData, 'articleStore');
    }

    public function show(Request $request, $id)
    {
        $inputData = $request->all();
        $inputData['article_id'] = $id;
        if (isset($inputData['data']) && $inputData['data'] === '1') {
            return $this->dataHandler($inputData, 'articleItem');
        } else {
            return view('community.article.show');
        }
    }

    public function edit(Request $request)
    {
        return view('community.article.edit');
    }

    public function update(Request $request)
    {
        $inputData = $request->all();

        return $this->dataHandler($inputData, 'articleUpdate');
    }

    public function destroy(Request $request)
    {

    }

    public function dataHandler(array $inputData, string $classification)
    {
        $service = new ArticleService();
        try {
            $resultData = $service->dataHandler($inputData, $classification);

            return $this->response($resultData);
        } catch (ValidateException $exception) {
            return $this->setStatusCode($exception->getCode())
                ->responseError($exception->getCode(), $exception->getMessage());
        }
    }
}
