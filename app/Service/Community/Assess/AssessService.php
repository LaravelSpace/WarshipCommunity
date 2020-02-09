<?php

namespace App\Service\Community\Assess;


use App\Service\Community\Article\Model\ArticleModel;
use App\Service\Community\Assess\Model\BookmarkModel;
use App\Service\Community\Assess\Model\StarModel;

class AssessService
{
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

    public function starToggle($userId, $classification, $id)
    {
        $classificationArr = config('constant.classification');
        if (!in_array($classification, $classificationArr, true)) {
        }
        $sqlField = ['user_id' => $userId, 'classification' => $classification, 'target_id' => $id];
        $dbStar = StarModel::where($sqlField)->first();
        if (empty($dbStar)) {
            $sqlField['created_at'] = dateTimeNow();
            StarModel::create($sqlField);
            $this->updateTargetStar($classification, $id, true);

            return ['star' => true];
        }
        StarModel::where('id', '=', $dbStar->id)->delete();
        $this->updateTargetStar($classification, $id, false);

        return ['star' => false];
    }

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

    public function bookmarkToggle($userId, $classification, $id)
    {
        $classificationArr = config('constant.classification');
        if (!in_array($classification, $classificationArr, true)) {
        }
        $sqlField = ['user_id' => $userId, 'classification' => $classification, 'target_id' => $id];
        $dbStar = BookmarkModel::where($sqlField)->first();
        if (empty($dbStar)) {
            $sqlField['created_at'] = dateTimeNow();
            BookmarkModel::create($sqlField);
            $this->updateTargetBookmark($classification, $id, true);

            return ['bookmark' => true];
        }
        BookmarkModel::where('id', '=', $dbStar->id)->delete();
        $this->updateTargetBookmark($classification, $id, false);

        return ['bookmark' => false];
    }

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
