<?php

namespace App\Service\Community\Article\Handler;


use App\Service\Community\Article\Model\Comment;

class CommentHandler
{
    public function listComment(string $classification, int $id, int $page)
    {
        if ($classification === 'article') {
            $whereField = ['article_id' => $id];
        } else if ($classification === 'user') {
            $whereField = ['user_id' => $id];
        } else {
            $whereField = ['article_id' => $id];
        }
        $dbCommentList = Comment::query()->where($whereField)->passExamine()->notInBlacklist()->get();

        $commentList = [];
        if ($dbCommentList->count() > 0) {
            $dbCommentList = $dbCommentList->toArray();
            foreach ($dbCommentList as $item){
                $body = $this->getFromFile($item['user_id'], $item['body']);
                $item['body'] = $body;
                $commentList[] = $item;
            }
        }

        return $commentList;
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
        $filePath = config('constant.file_path.comment') . $userId . '/' . $key . '.txt';
        try {
            $body = file_get_contents($filePath);
        } catch (\Exception $e) {
            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $body = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
        }

        return $body;
    }
}
