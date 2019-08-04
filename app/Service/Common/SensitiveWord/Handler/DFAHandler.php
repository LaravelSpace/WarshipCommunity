<?php

namespace App\Service\Common\SensitiveWord\Handler;


use App\Service\Common\SensitiveWord\SensitiveWord\CheckSensitiveWord;

/**
 * Class DFAHandler
 * 敏感词过滤 DFA 算法
 *
 * @package App\CommonService\SensitiveWord\Handler
 */
class DFAHandler implements CheckSensitiveWord
{
    private $sensitiveWordMap;

    public function __construct()
    {
        $this->sensitiveWordMap = [];
        $this->iInitSensitiveWordMap();
    }

    /**
     * 初始化敏感词数据结构
     */
    private function iInitSensitiveWordMap()
    {
        $sensitiveWordSet = $this->iGetSensitiveWordSet();

        foreach ($sensitiveWordSet as $word) {
            $arrayHashMap = &$this->sensitiveWordMap; // 传址
            $wordLength = mb_strlen($word, "UTF-8");
            for ($i = 0; $i < $wordLength; $i++) {
                $key = mb_substr($word, $i, 1, "UTF-8");
                if (isset($arrayHashMap[$key])) {
                    if ($i == ($wordLength - 1)) {
                        $arrayHashMap[$key]["end"] = 1;
                    }
                } else {
                    if ($i == ($wordLength - 1)) {
                        $arrayHashMap[$key] = [];
                        $arrayHashMap[$key]["end"] = 1;
                    } else {
                        $arrayHashMap[$key] = [];
                        $arrayHashMap[$key]["end"] = 0;
                    }
                }
                $arrayHashMap = &$arrayHashMap[$key]; // 传址
            }
        }
    }

    /**
     * 获取敏感词词库
     *
     * @return array
     */
    private function iGetSensitiveWordSet()
    {
        $sensitiveWordSet = ["王八羔子", "兔崽子", "王八蛋", "傻逼", "法轮", "法轮功", "李洪志", "中国猪", "台湾猪"];

        return $sensitiveWordSet;
    }

    /**
     * 返回敏感词数据结构
     *
     * @return array
     */
    public function getSensitiveWordMap()
    {
        return $this->sensitiveWordMap;
    }

    /**
     * 校验字符串里是否有敏感词并返回匹配到的结果
     *
     * @param string $checkString
     * @return array
     */
    public function checkSensitiveWord(string $checkString)
    {
        $stringLength = mb_strlen($checkString, "UTF-8");
        $arrayHashMap = $this->sensitiveWordMap;
        $markedSensitiveWordSet = [];
        $markedSensitiveWord = '';
        for ($i = 0; $i < $stringLength; $i++) {
            $checkKey = mb_substr($checkString, $i, 1, "UTF-8");
            if (!isset($arrayHashMap[$checkKey])) {
                $markedSensitiveWord = '';
                $arrayHashMap = $this->sensitiveWordMap; // 重置 $arrayHashMap
                if (!isset($arrayHashMap[$checkKey])) {
                    continue;
                }
            }
            $markedSensitiveWord .= $checkKey;
            if ($arrayHashMap[$checkKey]["end"] == 1) {
                $markedSensitiveWordSet[] = $markedSensitiveWord;
                $markedSensitiveWord = '';
                $arrayHashMap = $this->sensitiveWordMap; // 重置 $arrayHashMap

                continue;
            }
            $arrayHashMap = $arrayHashMap[$checkKey];
        }

        return $markedSensitiveWordSet;
    }
}
