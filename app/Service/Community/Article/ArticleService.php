<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\ArticleHandler;

class ArticleService
{
    /**
     * 获取帖子列表
     *
     * @param int $page    [当前页数]
     * @param int $perPage [每页数量]
     * @return array [帖子列表]
     */
    public function listModel(int $page = 1, int $perPage = 10)
    {
        return (new ArticleHandler())->listArticle($page, $perPage);
    }

    /**
     * 创建帖子
     *
     * @param int    $userId       [用户 id]
     * @param string $articleTitle [帖子标题]
     * @param string $articleBody  [帖子内容]
     * @return Model\ArticleModel [帖子实例]
     * @throws \App\Exceptions\ServiceException
     */
    public function createModel(int $userId, string $articleTitle, string $articleBody)
    {
        return (new ArticleHandler())->createArticle($userId, $articleTitle, $articleBody);
    }

    /**
     * 获取帖子
     *
     * @param int  $articleId   [帖子 id]
     * @param bool $useMarkdown [是否使用 MarkDown 格式解析]
     * @return array [帖子实例]
     * @throws \App\Exceptions\ServiceException
     */
    public function getModel(int $articleId, bool $useMarkdown = false)
    {
        return (new ArticleHandler())->getArticle($articleId, $useMarkdown);
    }

    /**
     * 更新帖子
     *
     * @param int    $articleId    [帖子 id]
     * @param string $articleTitle [帖子标题]
     * @param string $articleBody  [帖子内容]
     * @return int [帖子 id]
     */
    public function updateModel(int $articleId, string $articleTitle, string $articleBody)
    {
        return (new ArticleHandler())->updateArticle($articleId, $articleTitle, $articleBody);
    }

    /**
     * 删除帖子
     *
     * @param int $articleId [帖子 id]
     * @return int [帖子 id]
     */
    public function deleteModel(int $articleId)
    {
        return (new ArticleHandler())->deleteArticle($articleId);
    }
}
