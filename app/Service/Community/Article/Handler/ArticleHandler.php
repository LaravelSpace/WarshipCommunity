<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\Article;
use Parsedown;

class ArticleHandler
{
    public function createArticle(array $user, string $title, string $body)
    {
        $key = makeUniqueKey32();
        $this->saveToFile($user['id'], $key, $body);
        $createField = ['title' => $title, 'body' => $key, 'user_id' => $user['id'], 'examine' => 1];
        $dbArticle = Article::create($createField);
        $classification = config('constant.classification.article');
        event(new ArticleSensitiveEvent($classification, $dbArticle->id));

        return $dbArticle->id;
    }

    public function listArticle(int $page)
    {
        $articleData = [
            'article_list' => [],
            'paginate'     => []
        ];
        $dbArticleList = Article::query()->passExamine()->notInBlacklist()->with('user')->simplePaginate(10);
        if ($dbArticleList->count() > 0) {
            $dbArticleList = $dbArticleList->toArray();
            // 计算分页
            $prevMinPage = $dbArticleList['current_page'] - 3;
            $nextMaxPage = $dbArticleList['current_page'] + 4;
            $pageList = [];
            $count = Article::query()->passExamine()->notInBlacklist()->count();
            $maxPage = (int)($count / 10) + 2;
            for ($i = $prevMinPage; $i < $nextMaxPage; $i++) {
                if ($i > 0 && $i < $maxPage) {
                    $pageList[] = $i;
                }
            }
            $prevPage = ($dbArticleList['current_page'] - 1) > 0 ? $dbArticleList['current_page'] - 1 : '';
            $nextPage = ($dbArticleList['current_page'] + 1) < $maxPage ? $dbArticleList['current_page'] + 1 : '';
            $paginate = [
                'prev_page'    => $prevPage,
                'current_page' => $dbArticleList['current_page'],
                'next_page'    => $nextPage,
                'page_list'    => $pageList,
            ];
            $articleData = [
                'article_list' => $dbArticleList['data'],
                'paginate'     => $paginate,
            ];
        }

        return $articleData;
    }

    public function getArticle(int $id, bool $markdown)
    {
        try {
            $dbArticle = Article::find($id)->toArray();
            $body = $this->getFromFile($dbArticle['user_id'], $dbArticle['body']);
            if ($markdown) {
                $dbArticle['body'] = (new Parsedown())->text($body);
            } else {
                $dbArticle['body'] = $body;
            }
        } catch (\Exception $e) {
            $dbArticle = [];
        }

        return $dbArticle;
    }

    public function updateArticle(int $id, string $title, string $body)
    {
        $updateField = ['title' => $title, 'body' => $body, 'examine' => 1];
        $rows = Article::where('id', '=', $id)->update($updateField);
        if ($rows > 0) {
            event(new ArticleSensitiveEvent('article', $id));
        }

        return $id;
    }

    public function deleteArticle(int $id)
    {
        // $whereField = ['id' => $id];
        // $rows = Article::where($whereField)->delete();

        return $id;
    }

    /**
     * @param int    $userId
     * @param string $key
     * @param string $body
     */
    public function saveToFile(int $userId, string $key, string $body)
    {
        $fileName = $key . '.txt';
        // 创建目录
        try {
            $dirPath = config('constant.file_path.article') . $userId . '/';
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            // 记录文本
            $filePath = $dirPath . $fileName;
            try {
                file_put_contents($filePath, $body);
            } catch (\Exception $e) {
                $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
                $text = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
                file_put_contents($filePath, $text);
            }
        } catch (\Exception $e) {
            $filePath = config('constant.file_path.exception') . $fileName . '.log';
            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $text = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
            file_put_contents($filePath, $text);
        }
    }

    public function getFromFile(int $userId, string $key)
    {
        $filePath = config('constant.file_path.article') . $userId . '/' . $key . '.txt';
        try {
            $body = file_get_contents($filePath);
        } catch (\Exception $e) {
            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $body = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
        }

        return $body;
    }
}
