<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\CommentModel;
use Parsedown;

class CommentHandler
{
    use PaginateTrait, FileStorageTrait;

    /**
     * @param string $classification
     * @param int    $targetId
     * @param int    $page
     * @param int    $perPage
     * @return array
     */
    public function listComment(string $classification, int $targetId, int $page, int $perPage)
    {
        $whereField = ['article_id' => $targetId];
        if ($classification === config('constant.classification.user')) {
            $whereField = ['user_id' => $targetId];
        }
        $dbPaginate = CommentModel::where($whereField)->passExamine()->notInBlacklist()
            ->with('user:id,name,avatar')->simplePaginate($perPage);

        $resultData = $this->makePaginate(new CommentModel(), $dbPaginate, $perPage, $whereField);

        $listData = [];
        $commentPath = config('constant.file_path.comment_storage');
        foreach ($resultData['list'] as $item) {
            $dirPath = $commentPath . $item['user_id'] . '/';
            $dirPath = storage_path($dirPath);
            $fileName = $item['body'] . '.txt';
            try {
                $body = $this->getFromFile($dirPath, $fileName);
                $item['body'] = (new Parsedown())->text($body);;
                $listData[] = $item;
            } catch (\Exception $e) {
                gSaveExceptionToFile($fileName, $e);
            }
        }
        $resultData['list'] = $listData;

        return $resultData;
    }

    /**
     * @param $classification
     * @param $targetId
     * @param $page
     * @param $perPage
     * @return array
     */
    public function listCommentWithDiscussion($classification, $targetId, $page, $perPage)
    {
        $commentList = $this->listComment($classification, $targetId, $page, $perPage);
        $hDiscussion = new DiscussionHandler();
        foreach ($commentList['list'] as $index => $itemComment){
            $commentList['list'][$index]['discussion_list'] = $hDiscussion->listDiscussion($itemComment['id']);
        }

        return $commentList;
    }

    /**
     * @param int    $userId
     * @param string $articleId
     * @param string $commentBody
     * @return int
     * @throws \App\Exceptions\ServiceException
     */
    public function createComment(int $userId, string $articleId, string $commentBody)
    {
        $uniqueKey = gMakeUniqueKey32();
        $dirPath = config('constant.file_path.comment_storage') . $userId . '/';
        $dirPath = storage_path($dirPath);
        $fileName = $uniqueKey . '.txt';
        $this->saveToFile($dirPath, $fileName, $commentBody);
        $whereField = ['article_id' => $articleId];
        $dbCount = CommentModel::where($whereField)->count();
        $createField = [
            'body'          => $uniqueKey,
            'article_id'    => $articleId,
            'article_floor' => $dbCount + 1,
            'user_id'       => $userId,
            'examine'       => config('field_transform.examine.wait'),
        ];
        $dbComment = CommentModel::create($createField);
        $classification = config('constant.classification.comment');
        event(new ArticleSensitiveEvent($classification, $dbComment->id));

        return $dbComment;
    }
}
