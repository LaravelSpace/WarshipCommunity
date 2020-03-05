<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\SignCalendarModel;

class SignCalendarHandler
{
    public function getSignCalendar(int $userId)
    {
        $time = time();
        $monthStr = date('Y-m', $time);
        // 获取本月有多少天
        $dayNum = date('t', $time);
        $dbCalendarList = SignCalendarModel::query()
            ->select('sign_date')
            ->where('user_id', '=', $userId)
            ->where('sign_date', '>=', "{$monthStr}-01")
            ->get();
        $signDateList = [];
        foreach ($dbCalendarList as $item) {
            $signDateList[$item->sign_date] = 1;
        }
        for ($i = 1; $i <= $dayNum; $i++) {
            if ($i < 10) {
                $iStr = '0' . $i;
            } else {
                $iStr = $i;
            }
            $dateStr = "{$monthStr}-{$iStr}";
            if (isset($signDateList[$dateStr])) {
                continue;
            }
            $signDateList[$dateStr] = 0;
        }
        ksort($signDateList);

        return $signDateList;
    }

    public function markSignCalendar(int $userId)
    {
        $whereField = [
            'user_id'   => $userId,
            'sign_date' => gDateNow(),
        ];
        $dbCalendar = SignCalendarModel::query()->where($whereField)->first();
        if (!empty($dbCalendar)) {
            return;
        }
        SignCalendarModel::query()->create($whereField);

        return $this->getSignCalendar($userId);
    }
}
