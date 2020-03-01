<?php

namespace App\Service\Community\Article;


use App\Service\Community\Article\Handler\CommentHandler;

class CommentService
{
    /**
     * @param string $classification [查询类型]
     * @param int    $targetId       [查询类型目标 id]
     * @param bool   $withDiscussion [是否携带讨论列表]
     * @param int    $page           [当前页数]
     * @param int    $perPage        [每页数量]
     * @return array [评论列表]
     */
    public function listModel(string $classification, int $targetId, bool $withDiscussion = false, int $page = 1, int $perPage = 10)
    {
        if ($withDiscussion) {
            return (new CommentHandler())->listCommentWithDiscussion($classification, $targetId, $page, $perPage);
        }
        return (new CommentHandler())->listComment($classification, $targetId, $page, $perPage);
    }

    /**
     * @param int    $userId      [用户 id]
     * @param string $articleId   [帖子 id]
     * @param string $commentBody [评论内容]
     * @return \Illuminate\Database\Eloquent\Model [评论实例]
     * @throws \App\Exceptions\ServiceException
     */
    public function createModel(int $userId, string $articleId, string $commentBody)
    {
        return (new CommentHandler())->createComment($userId, $articleId, $commentBody);
    }

    /**
     * @param int  $commentId   [评论 id]
     * @param bool $useMarkdown [是否使用 MarkDown 格式解析]
     * @return array [评论实例]
     * @throws \App\Exceptions\ServiceException
     */
    public function getModel(int $commentId, bool $useMarkdown = false)
    {
        return (new CommentHandler())->getModel($commentId, $useMarkdown);
    }

    public function updateModel()
    {
    }

    public function deleteModel()
    {
    }
}
