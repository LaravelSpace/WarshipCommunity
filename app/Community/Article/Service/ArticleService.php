<?php

namespace App\Community\Article\Service;


use App\Community\Article\Handler\ArticleHandler;
use App\Exceptions\ValidateException;

class ArticleService
{
    /**
     * @param array  $inputData
     * @param string $classification
     *
     * @return mixed
     * @throws ValidateException
     */
    public function article(array $inputData, string $classification)
    {
        $handler = new ArticleHandler();
        switch ($classification) {
            case 'articleList':
                $resultData = $handler->articleList($inputData);
                break;
            case 'articleCreate':
                $resultData = $handler->articleCreate($inputData);
                break;
            case 'articleSelect':
                $resultData = $handler->articleSelect($inputData);
                break;
            case 'articleUpdate':
                $resultData = $handler->articleUpdate($inputData);
                break;
            case 'articleDelete':
                $resultData = $handler->articleDelete($inputData);
                break;
            default:
                $message = ValidateException::SWITCH_NON_EXISTENT_CASE . 'CASE=' . $classification;
                throw new ValidateException($message, config('constant.http_code_500'));
        }
        return $resultData;
    }
}
