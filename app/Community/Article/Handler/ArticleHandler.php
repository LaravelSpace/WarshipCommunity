<?php

namespace App\Community\Article\Handler;


use App\Community\Article\Model\Article;
use Parsedown;

class ArticleHandler
{
    public function articleList(array $inputData)
    {
        $articleList = Article::with('user')->get();
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
        $articleData = [
            'title'     => $inputData['title'],
            'main_body' => $inputData['body'],
            'user_id'   => 1, // todo test data
        ];
        $article = Article::create($articleData);
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $article->toArray(),
        ];

        return $returnData;
    }

    public function articleItem(array $inputData)
    {
        $articleId = (int)$inputData['article_id'];
        $articleItem = Article::find($articleId);
        if ($articleItem !== null) {
            $articleItem = $articleItem->toArray();
            // 修改页面返回原值，展示页面使用解析器解析 markdown 文本
            if (!isset($inputData['markdown']) || !$inputData['markdown'] === '1') {
                $articleItem['main_body'] = (new Parsedown())->text($articleItem['main_body']);
            }
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
        $articleId = $inputData['id'];
        $articleData = [
            'title'     => $inputData['title'],
            'main_body' => $inputData['body'],
        ];
        Article::where('id', '=', $articleId)->update($articleData);
        $returnData = [
            'status' => config('constant.success'),
            'data'   => ['id' => $articleId],
        ];

        return $returnData;
    }

    public function articleDelete(array $inputData)
    {
    }
}
