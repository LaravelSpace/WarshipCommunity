<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\Comment;

class CommentHandler
{
    public function createComment(array $user, string $articleId, string $body)
    {
        $key = makeUniqueKey32();
        $this->saveToFile($user['id'], $key, $body);
        $whereField = ['article_id' => $articleId];
        $maxArticleFloor = Comment::where($whereField)->count();
        $createField = [
            'body'          => $key,
            'article_id'    => $articleId,
            'article_floor' => $maxArticleFloor + 1,
            'user_id'       => $user['id'],
            'examine'       => 1,
        ];
        $dbComment = Comment::create($createField);
        $classification = config('constant.classification.comment');
        event(new ArticleSensitiveEvent($classification, $dbComment->id));

        return $dbComment->id;
    }

    public function listComment(string $classification, int $id, int $page)
    {
        $commentData = ['comment_list' => [], 'paginate' => []];

        $whereField = ['article_id' => $id];
        if ($classification === 'user') {
            $whereField = ['user_id' => $id];
        }
        $dbCommentList = Comment::query()->where($whereField)->passExamine()->notInBlacklist()->with('user')->simplePaginate(10);
        if ($dbCommentList->count() > 0) {
            $dbCommentList = $dbCommentList->toArray();
            // 获取内容
            $commentList = [];
            foreach ($dbCommentList as $item) {
                $body = $this->getFromFile($item['user_id'], $item['body']);
                $item['body'] = $body;
                $commentList[] = $item;
            }
            // 计算分页
            $prevMinPage = $dbCommentList['current_page'] - 3;
            $nextMaxPage = $dbCommentList['current_page'] + 4;
            $pageList = [];
            $count = Comment::query()->passExamine()->notInBlacklist()->count();
            $maxPage = (int)($count / 10) + 2;
            $lastPageNum = $count % 10;
            for ($i = $prevMinPage; $i < $nextMaxPage; $i++) {
                if ($i > 0 && $i < $maxPage) {
                    $pageList[] = $i;
                }
            }
            $prevPage = ($dbCommentList['current_page'] - 1) > 0 ? $dbCommentList['current_page'] - 1 : '';
            $nextPage = ($dbCommentList['current_page'] + 1) < $maxPage ? $dbCommentList['current_page'] + 1 : '';
            $paginate = [
                'prev_page'     => $prevPage,
                'current_page'  => $dbCommentList['current_page'],
                'next_page'     => $nextPage,
                'page_list'     => $pageList,
                'last_page_num' => $lastPageNum,
            ];
            $commentData = ['comment_list' => $commentList, 'paginate' => $paginate];
        }

        return $commentData;
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
