<?php

namespace App\Community\Article\Service;


use App\Community\Article\Repository\ArticleRepository;

class ArticleService
{
    /**
     * 获取文章列表
     *
     * @return array
     */
    public function getArticleList()
    {
        $articleList = (new ArticleRepository())->getArticleList();
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $articleList,
        ];

        return $returnData;
    }
}
