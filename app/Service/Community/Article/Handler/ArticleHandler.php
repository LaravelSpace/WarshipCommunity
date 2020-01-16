<?php

namespace App\Service\Community\Article\Handler;


use App\Events\Community\ArticleSensitiveEvent;
use App\Service\Community\Article\Model\ArticleModel;
use Parsedown;

class ArticleHandler
{
    use PaginateTrait, FileStorageTrait;

    public function listArticle(int $page, int $perPage)
    {
        $dbPaginate = ArticleModel::query()->passExamine()->notInBlacklist()->latest()
            ->with('user:id,avatar')->simplePaginate($perPage);

        return $this->makePaginate(new ArticleModel(), $dbPaginate, $perPage);
    }

    /**
     * @param int    $userId
     * @param string $title
     * @param string $body
     * @return int|mixed
     * @throws \App\Exceptions\ServiceException
     */
    public function createArticle(int $userId, string $title, string $body)
    {
        $key = makeUniqueKey32();
        $dirPath = config('constant.file_path.article') . $userId . '/';
        $this->saveToFile($dirPath, $key, $body);
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

    /**
     * @param int  $id
     * @param bool $markdown
     * @return array
     * @throws \App\Exceptions\ServiceException
     */
    public function getArticle(int $id, bool $markdown)
    {
        $dbArticle = ArticleModel::findOrFail($id)->toArray();
        $dirPath = config('constant.file_path.article') . $dbArticle['user_id'] . '/';
        $body = $this->getFromFile($dirPath, $dbArticle['body']);
        if ($markdown) {
            $dbArticle['body'] = (new Parsedown())->text($body);
        } else {
            $dbArticle['body'] = $body;
        }

        return $dbArticle;
    }

    /**
     * @param int    $id
     * @param string $title
     * @param string $body
     * @return int
     */
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
}
