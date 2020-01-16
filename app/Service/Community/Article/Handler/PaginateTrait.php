<?php

namespace App\Service\Community\Article\Handler;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;

trait PaginateTrait
{
    /**
     * @param Model     $model
     * @param Paginator $dbPaginate
     * @param int       $perPage
     * @param array     $whereField
     * @return array
     */
    public function makePaginate(Model $model, Paginator $dbPaginate, int $perPage, array $whereField = [])
    {
        $paginateData = [
            'list'     => [],
            'paginate' => [],
        ];
        if ($dbPaginate->count() > 0) {
            $dbPaginate = $dbPaginate->toArray();
            // 计算分页
            $prevMinPage = $dbPaginate['current_page'] - 3;
            $nextMaxPage = $dbPaginate['current_page'] + 4;
            $pageList = [];
            if (!empty($whereField)) {
                $dbCount = $model->query()->where($whereField)->passExamine()->notInBlacklist()->count();
            } else {
                $dbCount = $model->query()->passExamine()->notInBlacklist()->count();
            }
            $maxPage = (int)($dbCount / $perPage) + 2;
            $lastPageNum = $dbCount % $perPage;
            for ($i = $prevMinPage; $i < $nextMaxPage; $i++) {
                if ($i > 0 && $i < $maxPage) {
                    $pageList[] = $i;
                }
            }
            $prevPage = ($dbPaginate['current_page'] - 1) > 0 ? $dbPaginate['current_page'] - 1 : '';
            $nextPage = ($dbPaginate['current_page'] + 1) < $maxPage ? $dbPaginate['current_page'] + 1 : '';
            $paginate = [
                'prev_page'     => $prevPage,
                'current_page'  => $dbPaginate['current_page'],
                'next_page'     => $nextPage,
                'page_list'     => $pageList,
                'last_page_num' => $lastPageNum,
            ];
            $paginateData = [
                'list'     => $dbPaginate['data'],
                'paginate' => $paginate,
            ];
        }

        return $paginateData;
    }
}
