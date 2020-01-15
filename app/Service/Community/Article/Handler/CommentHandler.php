<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\CommentModel;

class CommentHandler
{
    use PaginateTrait;

    public function listComment(string $classification, int $id, int $page, int $perPage)
    {
        $whereField = ['article_id' => $id];
        if ($classification === config('constant.classification.user')) {
            $whereField = ['user_id' => $id];
        }
        $dbPaginate = CommentModel::query()->where($whereField)->passExamine()->notInBlacklist()
            ->latest()->with('user:id,avatar')->simplePaginate($perPage);

        $resultData = $this->makePaginate(new CommentModel(), $dbPaginate, $perPage, $whereField);

        // 获取内容
        $listData = [];
        foreach ($resultData['list'] as $item) {
            $body = $this->getFromFile($item['user_id'], $item['body']);
            $item['body'] = $body;
            $listData[] = $item;
        }
        $resultData['list'] = $listData;

        return $resultData;
    }

    public function createComment(int $userId, string $articleId, string $body)
    {
        $key = makeUniqueKey32();
        $this->saveToFile($userId, $key, $body);
        $whereField = ['article_id' => $articleId];
        $dbCount = CommentModel::where($whereField)->count();
        $createField = [
            'body'          => $key,
            'article_id'    => $articleId,
            'article_floor' => $dbCount + 1,
            'user_id'       => $userId,
            'examine'       => config('field_transform.examine.wait'),
        ];
        $dbComment = CommentModel::create($createField);
        $classification = config('constant.classification.comment');
        event(new ArticleSensitiveEvent($classification, $dbComment->id));

        return $dbComment->id;
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
            $dirPath = config('constant.file_path.comment') . $userId . '/';
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
        $filePath = config('constant.file_path.comment') . $userId . '/' . $key . '.txt';
        try {
            $body = file_get_contents($filePath);
        } catch (\Exception $e) {
            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $body = "\nTIME IS:" . dateTimeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
        }

        return $body;
    }
}
