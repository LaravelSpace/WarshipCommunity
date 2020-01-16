<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\CommentModel;

class CommentHandler
{
    use PaginateTrait, FileStorageTrait;

    /**
     * @param string $classification
     * @param int    $id
     * @param int    $page
     * @param int    $perPage
     * @return array
     */
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
        $commentPath = config('constant.file_path.comment');
        foreach ($resultData['list'] as $item) {
            try {
                $dirPath = $commentPath . $item['user_id'] . '/';
                $body = $this->getFromFile($dirPath, $item['body']);
                $item['body'] = $body;
                $listData[] = $item;
            } catch (\Exception $e) {
                \Log::warning($e->getTraceAsString());
            }
        }
        $resultData['list'] = $listData;

        return $resultData;
    }

    /**
     * @param int    $userId
     * @param string $articleId
     * @param string $body
     * @return int|mixed
     * @throws \App\Exceptions\ServiceException
     */
    public function createComment(int $userId, string $articleId, string $body)
    {
        $key = makeUniqueKey32();
        $dirPath = config('constant.file_path.comment') . $userId . '/';
        $this->saveToFile($dirPath, $key, $body);
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
}
