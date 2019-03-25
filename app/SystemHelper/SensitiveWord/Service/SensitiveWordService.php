<?php

namespace App\SystemHelper\SensitiveWord\Service;

/**
 * 敏感词匹配
 *
 * Class SensitiveWordService
 * @package App\Http\Service\Index
 */
class SensitiveWordService
{
    private $sensitiveWordMapByDFA; // DFA 算法 敏感词数据结构

    /**
     * SensitiveWordService constructor.
     */
    public function __construct()
    {
        $this->sensitiveWordMapByDFA = [];
        $this->iInitSensitiveWordMapByDFA();
    }

    /**
     * 获取敏感词词库
     *
     * @return array
     */
    private function iGetSensitiveWordSet()
    {
        $sensitiveWordSet = ['王八羔子', '兔崽子', '王八蛋'];

        return $sensitiveWordSet;
    }

    /**
     * 初始化 DFA 算法 敏感词数据结构
     */
    private function iInitSensitiveWordMapByDFA()
    {
        $sensitiveWordSet = $this->iGetSensitiveWordSet();

        foreach ($sensitiveWordSet as $word) {
            $arrayHashMap = &$this->sensitiveWordMapByDFA; // 传址
            $wordLength = mb_strlen($word, 'UTF-8');
            for ($i = 0; $i < $wordLength; $i++) {
                $key = mb_substr($word, $i, 1, 'UTF-8');
                if (isset($arrayHashMap[$key])) {
                    if ($i == ($wordLength - 1)) {
                        $arrayHashMap[$key]['end'] = 1;
                    }
                } else {
                    if ($i == ($wordLength - 1)) {
                        $arrayHashMap[$key] = [];
                        $arrayHashMap[$key]['end'] = 1;
                    } else {
                        $arrayHashMap[$key] = [];
                        $arrayHashMap[$key]['end'] = 0;
                    }
                }
                $arrayHashMap = &$arrayHashMap[$key]; // 传址
            }
        }
    }

    /**
     * 返回 DFA 算法 敏感词数据结构
     *
     * @return array
     */
    public function getSensitiveWordMapByDFA()
    {
        return $this->sensitiveWordMapByDFA;
    }

    /**
     * 校验字符串里是否有敏感词
     *
     * @param $checkString
     * @return array
     */
    public function checkSensitiveWordByDFA($checkString)
    {
        $stringLength = mb_strlen($checkString, 'UTF-8');
        $arrayHashMap = $this->sensitiveWordMapByDFA;
        $markedSensitiveWordSet = [];
        $markedSensitiveWord = '';
        for ($i = 0; $i < $stringLength; $i++) {
            $checkKey = mb_substr($checkString, $i, 1, 'UTF-8');
            if (!isset($arrayHashMap[$checkKey])) {
                $arrayHashMap = $this->sensitiveWordMapByDFA; // 重置 $arrayHashMap

                continue;
            }
            $markedSensitiveWord .= $checkKey;
            if ($arrayHashMap[$checkKey]['end'] == 1) {
                $markedSensitiveWordSet[] = $markedSensitiveWord;
                $markedSensitiveWord = '';

                $arrayHashMap = $this->sensitiveWordMapByDFA; // 重置 $arrayHashMap

                continue;
            }
            $arrayHashMap = $arrayHashMap[$checkKey];
        }

        return $markedSensitiveWordSet;
    }
}
