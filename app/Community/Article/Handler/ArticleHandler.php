<?php

namespace App\Community\Article\Handler;


use App\Community\Article\Repository\ArticleRepository;

class ArticleHandler
{
    /**
     * 获取文章列表
     *
     * @param array $inputData
     *
     * @return array
     */
    public function articleList(array $inputData)
    {
        $articleList = (new ArticleRepository())->articleList();
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $articleList,
        ];

        return $returnData;
    }

    public function articleCreate(array $inputData)
    {
        
    }

    public function articleSelect(array $inputData)
    {
    }

    public function articleUpdate(array $inputData)
    {
    }

    public function articleDelete(array $inputData)
    {
    }
}
