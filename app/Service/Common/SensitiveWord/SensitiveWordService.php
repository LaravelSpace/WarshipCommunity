<?php

namespace App\Service\Common\SensitiveWord;


use App\Service\Common\SensitiveWord\Handler\DFAHandler;
use App\Service\Common\SensitiveWord\Model\SensitiveResultModel;
use App\Service\Common\SensitiveWord\SensitiveWord\CheckSensitiveWord;
use App\Service\Community\Article\ArticleService;
use App\Service\Community\Article\CommentService;
use App\Service\Community\Article\DiscussionService;
use App\Service\Community\Article\Model\ArticleModel;
use App\Service\Community\Article\Model\CommentModel;
use App\Service\Community\Article\Model\DiscussionModel;

/**
 * Class SensitiveWordService
 *
 * @package App\Service\Common\SensitiveWord\Service
 */
class SensitiveWordService
{
    private $handler;

    /**
     * SensitiveWordService constructor.
     *
     * @param CheckSensitiveWord|null $handler
     */
    public function __construct(CheckSensitiveWord $handler = null)
    {
        if ($handler === null) {
            $this->handler = new DFAHandler();
        } else {
            $this->handler = $handler;
        }
    }

    /**
     * 校验字符串里是否有敏感词并返回匹配到的结果
     *
     * @param string $checkString
     * @return array
     */
    public function checkSensitiveByStr(string $checkString)
    {
        return $this->handler->checkSensitiveWord($checkString);
    }

    /**
     * 校验数据模型里是否有敏感词并返回匹配到的结果
     *
     * @param string $classification
     * @param int    $targetId
     * @return void
     * @throws \App\Exceptions\ServiceException
     */
    public function checkSensitiveByModel(string $classification, int $targetId)
    {
        $checkString = $this->iGetModelText($classification, $targetId);
        if (is_string($checkString)) {
            $result = $this->handler->checkSensitiveWord($checkString);
            $this->iHandleResult($classification, $targetId, $result);
        }
    }

    /**
     * 获取数据模型的待校验文本
     *
     * @param string $classification
     * @param int    $targetId
     * @return string
     * @throws \App\Exceptions\ServiceException
     */
    private function iGetModelText(string $classification, int $targetId)
    {
        $text = '';
        switch ($classification) {
            case 'article':
                $dbModel = (new ArticleService())->getModel($targetId);
                break;
            case 'comment':
                $dbModel = (new CommentService())->getModel($targetId);
                dd($dbModel);
                break;
            case 'discussion':
                $dbModel = (new DiscussionService())->getModel($targetId);
                break;
            default:
                $dbModel = null;
        }
        if (!empty($dbModel)) {
            $text = $dbModel['body'];
        }
        return $text;
    }

    /**
     * 更新数据模型的校验结果
     *
     * @param string $classification
     * @param int    $targetId
     * @param array  $result
     */
    private function iHandleResult(string $classification, int $targetId, array $result)
    {
        $examine = 'approve';
        $examineTrans = config('field_transform.examine');
        if (count($result) > 0) {
            $examine = 'reject';
            $createField = [
                'classification' => $classification,
                'target_id'      => $targetId,
                'result_data'    => json_encode($result),
            ];
            SensitiveResultModel::create($createField);
        }
        $whereField = ['id' => $targetId];
        $updateField = ['examine' => $examineTrans[$examine]];
        switch ($classification) {
            case 'article':
                ArticleModel::where($whereField)->update($updateField);
                break;
            case 'comment':
                CommentModel::where($whereField)->update($updateField);
                break;
            case 'discussion':
                DiscussionModel::where($whereField)->update($updateField);
                break;
        }
    }
}
