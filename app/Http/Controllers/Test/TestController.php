<?php

namespace App\Http\Controllers\Test;

use App\Events\Community\CheckSensitiveEvent;
use App\Service\Common\SensitiveWord\SensitiveWordService;
use App\Service\User\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function __construct()
    {
        if (!env('APP_DEBUG')) {
            abort(404); // 如果不是测试环境直接返回 404 页面
        }
    }

    public function test(Request $request)
    {
        // $dbUserList = DB::table('test_user_map')->get()->toArray();
        // $treeMap = [];
        // foreach ($dbUserList as $item) {
        //     $treeMap[(string)$item->user_id] = [
        //         'parent_id' => (string)$item->father_id,
        //         'name'    => $item->father_id,
        //     ];
        // }
        // $treeMap['1000'] = [
        //     'parent_id' => null,
        //     'name'    => 'root',
        // ];

        $array1 = ['12341','12342','12343'];
        $array2 = [12341,12342];
        dd(array_diff($array1,$array2));

        // for ($i = 1041; $i < 1501; $i++) {
        //     $userId = $i;
        //     $userList = DB::table('test_user_map')->get()->toArray();
        //     if (empty($userList)) {
        //         $fatherId = 1000;
        //         $grandfatherId = 1000;
        //         $ancestorId = 1000;
        //         if ($ancestorId === 1000) {
        //             $ancestorId = $userId;
        //         }
        //     } else {
        //         $father = $userList[array_rand($userList)];
        //         $fatherId = $father->user_id;
        //         $grandfatherId = $father->father_id;
        //         $ancestorId = $father->ancestor_id;
        //         if ($ancestorId === 1000) {
        //             $ancestorId = $userId;
        //         }
        //     }
        //     $createField = [
        //         'user_id'        => $userId,
        //         'father_id'      => $fatherId,
        //         'grandfather_id' => $grandfatherId,
        //         'ancestor_id'    => $ancestorId,
        //     ];
        //     DB::table('test_user_map')->insert($createField);
        // }

        // $tree = [
        //     'H' => ['parent_id' => 'G', 'name' => 'G'],
        //     'F' => ['parent_id' => 'G', 'name' => 'G'],
        //     'G' => ['parent_id' => 'D', 'name' => 'D'],
        //     'E' => ['parent_id' => 'D', 'name' => 'D'],
        //     'A' => ['parent_id' => 'E', 'name' => 'E'],
        //     'B' => ['parent_id' => 'C', 'name' => 'C'],
        //     'C' => ['parent_id' => 'E', 'name' => 'E'],
        //     'D' => ['parent_id' => null, 'name' => 'D'],
        // ];
        $r = $this->treeMapToTree($treeMap);
        dd($r);
        $t = $this->printTree($r);
        dd($t);
    }

    function printTree($tree)
    {
        $print = '';
        if (!is_null($tree) && count($tree) > 0) {
            $print .= '<ul>';
            foreach ($tree as $node) {
                $print .= '<li>' . $node['name'];
                $print .= $this->printTree($node['children']);
                $print .= '</li>';
            }
            $print .= '</ul>';
        }
        return $print;
    }

    public function parseTree($tree, $root = null)
    {
        $return = [];
        foreach ($tree as $child => $parent) {
            if ($parent == $root) {
                unset($tree[$child]);
                $return[] = array(
                    'name'     => $child,
                    'children' => $this->parseTree($tree, $child)
                );
            }
        }

        return empty($return) ? null : $return;
    }

    function treeMapToTree($treeMap)
    {
        $address = [];
        $tree = [];

        foreach ($treeMap as $childId => $parentData) {
            if (!isset($address[$childId])) {
                $address[$childId] = [
                    'name'     => $childId,
                    'children' => []
                ];
            }
            if (!empty($parentData['parent_id'])) {
                if (!isset($address[$parentData['parent_id']])) {
                    $parentNode = [
                        'name'     => $parentData['name'],
                        'children' => [&$address[$childId]],
                    ];
                    $address[$parentData['parent_id']] = $parentNode;
                }else {
                    $address[$parentData['parent_id']]['children'][] = &$address[$childId];
                }
            } else {
                $tree[$childId] = &$address[$childId];
            }
        }

        // $flat = array();
        // $tree = array();
        //
        // foreach ($array as $child => $parent) {
        //     if (!isset($flat[$child])) {
        //         $flat[$child] = array();
        //     }
        //     if (!empty($parent)) {
        //         $flat[$parent][$child] =& $flat[$child];
        //     } else {
        //         $tree[$child] =& $flat[$child];
        //     }
        // }

        return $tree;
    }

    private function iTestStoragePath()
    {
        dd(storage_path('logs'));
    }

    private function iTestSensitiveByStr()
    {
        $checkString = '王八羔王八子啊王八羔子啊兔崽兔崽子王八蛋';
        $checkResult = (new SensitiveWordService('DFA'))->checkSensitiveByStr($checkString);
        $returnData = [
            'controller'  => 'TestController',
            'function'    => 'iTestSensitiveByStr',
            'checkResult' => $checkResult
        ];

        return $returnData;
    }

    private function iTestSensitiveByModel()
    {
        // $classification = config('constant.classification.article');
        // $classification = config('constant.classification.comment');
        $classification = config('constant.classification.discussion');
        event(new CheckSensitiveEvent($classification, 4));
    }
}
