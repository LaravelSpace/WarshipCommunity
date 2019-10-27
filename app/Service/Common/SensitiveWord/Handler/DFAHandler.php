<?php

namespace App\Service\Common\SensitiveWord\Handler;


use App\Service\Common\SensitiveWord\SensitiveWord\CheckSensitiveWord;

/**
 * Class DFAHandler
 * 敏感词过滤 DFA 算法
 *
 * @package App\Service\Common\SensitiveWord\Handler
 */
class DFAHandler implements CheckSensitiveWord
{
    private $iWordMap;

    public function __construct()
    {
        $this->iWordMap = [];
        $this->iInitWordMap();
    }

    /**
     * 初始化敏感词数据结构
     */
    private function iInitWordMap()
    {
        $wordSet = $this->iGetWordSet();

        foreach ($wordSet as $word) {
            $arrayHashMap = &$this->iWordMap; // 传址
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
     * 获取敏感词词库
     *
     * @return array
     */
    private function iGetWordSet()
    {
        $wordSet = ['王八羔子', '兔崽子', '王八蛋', '傻逼', '法轮', '法轮功', '李洪志', '中国猪', '台湾猪'];

        return $wordSet;
    }

    /**
     * 返回敏感词数据结构
     *
     * @return array
     */
    public function getWordMap()
    {
        return $this->iWordMap;
    }

    /**
     * 校验字符串里是否有敏感词并返回匹配到的结果
     *
     * @param string $checkString
     * @return array
     */
    public function checkSensitiveWord(string $checkString)
    {
        $stringLength = mb_strlen($checkString, 'UTF-8');
        $arrayHashMap = $this->iWordMap;
        $markedWordSet = [];
        $markedWord = '';
        for ($i = 0; $i < $stringLength; $i++) {
            $checkKey = mb_substr($checkString, $i, 1, 'UTF-8');
            if (!isset($arrayHashMap[$checkKey])) {
                $markedWord = '';
                $arrayHashMap = $this->iWordMap; // 重置 $arrayHashMap
                if (!isset($arrayHashMap[$checkKey])) {
                    continue;
                }
            }
            $markedWord .= $checkKey;
            if ($arrayHashMap[$checkKey]['end'] == 1) {
                $markedWordSet[] = $markedWord;
                $markedWord = '';
                $arrayHashMap = $this->iWordMap; // 重置 $arrayHashMap

                continue;
            }
            $arrayHashMap = $arrayHashMap[$checkKey];
        }

        return $markedWordSet;
    }
}
