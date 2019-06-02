<?php

namespace App\Community\Article\Handler;


use App\Community\Article\Repository\ArticleRepository;

class ArticleHandler
{
    public function articleList(array $inputData)
    {
        $articleList = (new ArticleRepository())->articleList();
        if ($articleList->count() > 0) {
            $articleList = $articleList->toArray();
        } else {
            $articleList = [];
        }
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $articleList,
        ];

        return $returnData;
    }

    public function articleStore(array $inputData)
    {
        $articleData = ['title' => $inputData['title'],
        'main_body' => $inputData['body'],];

    }

    public function articleItem(array $inputData)
    {
        $articleId = (int)$inputData['article_id'];
        $articleItem = (new ArticleRepository())->articleItem($articleId);
        if ($articleItem !== null) {
            $articleItem = $articleItem->toArray();
        } else {
            $articleItem = [];
        }
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $articleItem,
        ];

        return $returnData;
    }

    public function articleUpdate(array $inputData)
    {
    }

    public function articleDelete(array $inputData)
    {
    }
}
