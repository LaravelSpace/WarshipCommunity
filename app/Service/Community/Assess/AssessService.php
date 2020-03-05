<?php

namespace App\Service\Community\Assess;


use App\Service\Community\Article\Model\ArticleModel;
use App\Service\Community\Assess\Model\BookmarkModel;
use App\Service\Community\Assess\Model\StarModel;

class AssessService
{
    /**
     * 获取星标和收藏
     *
     * @param int    $userId         [用户 id]
     * @param string $classification [查询类型]
     * @param array  $idArr          [目标 id 列表]
     * @return array
     */
    public function getAssess(int $userId, string $classification, array $idArr)
    {
        $classificationArr = config('constant.classification');
        if (!in_array($classification, $classificationArr, true)) {
            return [
                'star'     => false,
                'bookmark' => false,
            ];
        }
        $whereField = ['user_id' => $userId, 'classification' => $classification];
        $dbStar = StarModel::where($whereField)->where('target_id', '=', $idArr[0])->first();
        $dbBookmark = BookmarkModel::where($whereField)->where('target_id', '=', $idArr[0])->first();
        return [
            'star'     => !empty($dbStar),
            'bookmark' => !empty($dbBookmark),
        ];
    }

    /**
     * 切换星标状态
     *
     * @param int    $userId         [用户 id]
     * @param string $classification [查询类型]
     * @param int    $targetId       [目标 id]
     * @return array
     */
    public function starToggle(int $userId, string $classification, int $targetId)
    {
        $classificationArr = config('constant.classification');
        if (!in_array($classification, $classificationArr, true)) {
        }
        $sqlField = ['user_id' => $userId, 'classification' => $classification, 'target_id' => $targetId];
        $dbStar = StarModel::where($sqlField)->first();
        if (empty($dbStar)) {
            $sqlField['created_at'] = gDateTimeNow();
            StarModel::create($sqlField);
            $this->updateTargetStar($classification, $targetId, true);

            return ['star' => true];
        }
        StarModel::where('id', '=', $dbStar->id)->delete();
        $this->updateTargetStar($classification, $targetId, false);

        return ['star' => false];
    }

    /**
     * 更新目标的星标数量
     *
     * @param string $classification [查询类型]
     * @param int    $targetId       [目标 id]
     * @param bool   $isCreate       [true=>添加;false=>减少]
     */
    public function updateTargetStar(string $classification, int $targetId, bool $isCreate)
    {
        if ($classification === config('constant.classification.article')) {
            if ($isCreate) {
                ArticleModel::where('id', '=', $targetId)->increment('star_num', 1);
            } else {
                ArticleModel::where('id', '=', $targetId)->decrement('star_num', 1);
            }
        }
    }

    /**
     * 切换收藏状态
     *
     * @param int    $userId         [用户 id]
     * @param string $classification [查询类型]
     * @param int    $targetId       [目标 id]
     * @return array
     */
    public function bookmarkToggle(int $userId, string $classification, int $targetId)
    {
        $classificationArr = config('constant.classification');
        if (!in_array($classification, $classificationArr, true)) {
        }
        $sqlField = ['user_id' => $userId, 'classification' => $classification, 'target_id' => $targetId];
        $dbStar = BookmarkModel::where($sqlField)->first();
        if (empty($dbStar)) {
            $sqlField['created_at'] = gDateTimeNow();
            BookmarkModel::create($sqlField);
            $this->updateTargetBookmark($classification, $targetId, true);

            return ['bookmark' => true];
        }
        BookmarkModel::where('id', '=', $dbStar->id)->delete();
        $this->updateTargetBookmark($classification, $targetId, false);

        return ['bookmark' => false];
    }

    /**
     * 更新目标收藏数量
     *
     * @param string $classification [查询类型]
     * @param int    $targetId       [目标 id]
     * @param bool   $isCreate       [true=>添加;false=>减少]
     */
    public function updateTargetBookmark(string $classification, int $targetId, bool $isCreate)
    {
        if ($classification === config('constant.classification.article')) {
            if ($isCreate) {
                ArticleModel::where('id', '=', $targetId)->increment('bookmark_num', 1);
            } else {
                ArticleModel::where('id', '=', $targetId)->decrement('bookmark_num', 1);
            }
        }
    }
}
