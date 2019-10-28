<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\Article;
use App\Service\Community\Article\Model\Comment;
use Parsedown;

class ArticleHandler
{
    public function createArticle(array $user, string $title, string $body)
    {
        $createField = ['title' => $title, 'body' => $body, 'user_id' => $user['id'], 'examine' => 1];
        $dbArticle = Article::create($createField);

        event(new ArticleSensitiveEvent($dbArticle->id, 'article'));

        return $dbArticle->id;
    }

    public function getArticleList(int $page)
    {
        $dbArticleList = Article::query()->passExamine()->notInBlacklist()->with('user')->get();
        if ($dbArticleList->count() > 0) {
            $dbArticleList = $dbArticleList->toArray();
        } else {
            $dbArticleList = [];
        }

        return $dbArticleList;
    }

    public function getArticle(int $id, bool $markdown)
    {
        try {
            $dbArticle = Article::findOrFail($id)->toArray();
            if ($markdown) {
                $dbArticle['body'] = (new Parsedown())->text($dbArticle['body']);
            }
        } catch (\Exception $e) {
            $dbArticle = [];
        }

        return $dbArticle;
    }

    public function updateArticle(int $id, string $title, string $body)
    {
        $whereField = ['id' => $id];
        $updateField = ['title' => $title, 'body' => $body, 'examine' => 1];
        $rows = Article::where($whereField)->update($updateField);
        if ($rows > 0) {
            event(new ArticleSensitiveEvent($id, 'article'));
        }

        return $id;
    }

    public function deleteArticle(int $id)
    {
        $whereField = ['id' => $id];
        $rows = Article::where($whereField)->delete();

        return $id;
    }

    public function getCommentList(int $id)
    {
        $whereField = ['article_id'=>$id];
        $dbCommentList = Comment::query()->where($whereField)->passExamine()->notInBlacklist()->get();
        if ($dbCommentList->count() > 0) {
            $dbCommentList = $dbCommentList->toArray();
        } else {
            $dbCommentList = [];
        }

        return $dbCommentList;
    }
}
