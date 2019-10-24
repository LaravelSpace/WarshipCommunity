<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\Article;
use Parsedown;

class ArticleHandler
{
    public function articleStore(array $inputData)
    {

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
            'data'   => $articleItem
        ];

        return $returnData;
    }

    public function articleUpdate(array $inputData)
    {
        $articleId = $inputData['id'];
        $articleData = [
            'title'     => $inputData['title'],
            'main_body' => $inputData['body']
        ];
        Article::where('id', '=', $articleId)->update($articleData);

        $returnData = [
            'status' => config('constant.success'),
            'data'   => ['id' => $articleId]
        ];

        return $returnData;
    }

    public function getArticleList($page)
    {
        $articleList = Article::passExamine()->notInBlacklist()->with('user')->get();
        if ($articleList->count() > 0) {
            $articleList = $articleList->toArray();
        } else {
            $articleList = [];
        }

        return $articleList;
    }

    public function createArticle(array $user, string $title, string $body)
    {
        $articleData = [
            'title'     => $title,
            'main_body' => $body,
            'user_id'   => $user['id'],
            'examine'   => 1
        ];
        $article = Article::create($articleData);

        // event(new ArticleSensitiveEvent($article->id, 'article'));

        return $article->id;
    }
}
