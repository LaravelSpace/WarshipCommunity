<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\CheckSensitiveEvent;
use App\Service\Community\Article\Model\ArticleModel;
use Parsedown;

class ArticleHandler
{
    use PaginateTrait, FileStorageTrait;

    /**
     * @param int $page
     * @param int $perPage
     * @return array
     */
    public function listArticle(int $page, int $perPage)
    {
        $dbPaginate = ArticleModel::passExamine()->notInBlacklist()->latest()
            ->with('user:id,avatar')->simplePaginate($perPage);

        return $this->makePaginate(new ArticleModel(), $dbPaginate, $perPage);
    }

    /**
     * @param int    $userId
     * @param string $articleTitle
     * @param string $articleBody
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \App\Exceptions\ServiceException
     */
    public function createArticle(int $userId, string $articleTitle, string $articleBody)
    {
        $uniqueKey = gMakeUniqueKey32();
        $dirPath = config('constant.file_path.article_storage') . $userId . '/';
        $dirPath = storage_path($dirPath);
        $fileName = $uniqueKey . '.txt';
        $this->saveToFile($dirPath, $fileName, $articleBody);
        $createField = [
            'title'   => $articleTitle,
            'body'    => $uniqueKey,
            'user_id' => $userId,
            'examine' => config('field_transform.examine.wait'),
        ];
        $dbArticle = ArticleModel::create($createField);
        $classification = config('constant.classification.article');
        event(new CheckSensitiveEvent($classification, $dbArticle->id));

        return $dbArticle;
    }

    /**
     * @param int  $articleId
     * @param bool $useMarkdown
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function getArticle(int $articleId, bool $useMarkdown)
    {
        $dbArticle = ArticleModel::findOrFail($articleId)->toArray();
        $dirPath = config('constant.file_path.article_storage') . $dbArticle['user_id'] . '/';
        $dirPath = storage_path($dirPath);
        $fileName = $dbArticle['body'] . '.txt';
        $articleBody = $this->getFromFile($dirPath, $fileName);
        if ($useMarkdown) {
            $dbArticle['body'] = (new Parsedown())->text($articleBody);
        } else {
            $dbArticle['body'] = $articleBody;
        }

        return $dbArticle;
    }

    /**
     * @param int    $articleId
     * @param string $articleTitle
     * @param string $articleBody
     * @return int
     */
    public function updateArticle(int $articleId, string $articleTitle, string $articleBody)
    {
        $updateField = ['title' => $articleTitle, 'body' => $articleBody, 'examine' => 1];
        $rows = ArticleModel::where('id', '=', $articleId)->update($updateField);
        if ($rows > 0) {
            event(new CheckSensitiveEvent('article', $articleId));
        }

        return $articleId;
    }

    /**
     * @param int $articleId
     * @return int
     */
    public function deleteArticle(int $articleId)
    {
        $whereField = ['id' => $articleId];
        $rows = ArticleModel::where($whereField)->delete();

        return $articleId;
    }
}
