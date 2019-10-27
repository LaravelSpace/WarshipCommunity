<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\Article;
use Parsedown;

class ArticleHandler
{
    public function createArticle(array $user, string $title, string $body)
    {
        $createField = ['title' => $title, 'body' => $body, 'user_id' => $user['id'], 'examine' => 1];
        $article = Article::create($createField);

        event(new ArticleSensitiveEvent($article->id, 'article'));

        return $article->id;
    }

    public function getArticleList(int $page)
    {
        $articleList = Article::passExamine()->notInBlacklist()->with('user')->get();
        if ($articleList->count() > 0) {
            $articleList = $articleList->toArray();
        } else {
            $articleList = [];
        }

        return $articleList;
    }

    public function getArticle(int $id, bool $markdown)
    {
        try {
            $article = Article::findOrFail($id)->toArray();
            if ($markdown) {
                $article['body'] = (new Parsedown())->text($article['body']);
            }
        } catch (\Exception $e) {
            $article = [];
        }

        return $article;
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
}
