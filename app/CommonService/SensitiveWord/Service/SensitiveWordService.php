<?php

namespace App\CommonService\SensitiveWord\Service;


use App\CommonService\SensitiveWord\Handler\DFAHandler;

/**
 * Class SensitiveWordService
 *
 * 敏感词匹配
 *
 * @package App\Http\Service\Index
 */
class SensitiveWordService
{
    private $sensitiveWorldHandler;

    /**
     * SensitiveWordService constructor.
     *
     * @param string $algorithm [算法类型]
     */
    public function __construct(string $algorithm)
    {
        $this->sensitiveWorldHandler = $this->iSelectHandler($algorithm);
    }

    /**
     * 选择算法类型
     *
     * @param string $algorithm
     * @return DFAHandler
     */
    private function iSelectHandler(string $algorithm)
    {
        switch ($algorithm) {
            case 'DFA':
                $handler = new DFAHandler();
                break;
            default:
                $handler = new DFAHandler();
        }

        return $handler;
    }

    /**
     * 校验字符串里是否有敏感词并返回匹配到的结果
     *
     * @param string $checkString
     * @return array
     */
    public function checkSensitiveWord(string $checkString)
    {
        return $this->sensitiveWorldHandler->checkSensitiveWord($checkString);
    }
}
