<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\ArticleModel;
use Parsedown;

class ArticleHandler
{
    use PaginateTrait;

    public function listArticle(int $page, int $perPage)
    {
        $dbPaginate = ArticleModel::query()->passExamine()->notInBlacklist()->latest()
            ->with('user:id,avatar')->simplePaginate($perPage);

        return $this->makePaginate(new ArticleModel(), $dbPaginate, $perPage);
    }

    public function createArticle(int $userId, string $title, string $body)
    {
        $key = makeUniqueKey32();
        $this->saveToFile($userId, $key, $body);
        $createField = [
            'title'   => $title,
            'body'    => $key,
            'user_id' => $userId,
            'examine' => config('field_transform.examine.wait'),
        ];
        $dbArticle = ArticleModel::create($createField);
        $classification = config('constant.classification.article');
        event(new ArticleSensitiveEvent($classification, $dbArticle->id));

        return $dbArticle->id;
    }

    public function getArticle(int $id, bool $markdown)
    {
        try {
            $dbArticle = ArticleModel::findOrFail($id)->toArray();
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
        $rows = ArticleModel::where('id', '=', $id)->update($updateField);
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
                $text = "\nTIME IS:" . dateTimeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
                file_put_contents($filePath, $text);
            }
        } catch (\Exception $e) {
            $filePath = config('constant.file_path.exception') . $fileName . '.log';
            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $text = "\nTIME IS:" . dateTimeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
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
            $body = "\nTIME IS:" . dateTimeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
        }

        return $body;
    }
}
