<?php

namespace App\Service\Common\SensitiveWord;


use App\Service\Common\SensitiveWord\Handler\DFAHandler;
use App\Service\Common\SensitiveWord\SensitiveWord\CheckSensitiveWord;

/**
 * Class SensitiveWordService
 *
 * @package App\Service\Common\SensitiveWord\Service
 */
class SensitiveWordService
{
    private $handler;

    /**
     * SensitiveWordService constructor.
     *
     * @param CheckSensitiveWord|null $handler
     */
    public function __construct(CheckSensitiveWord $handler = null)
    {
        if ($handler === null) {
            $this->handler = new DFAHandler();
        } else {
            $this->handler = $handler;
        }
    }

    /**
     * 校验字符串里是否有敏感词并返回匹配到的结果
     *
     * @param string $checkString
     * @return array
     */
    public function checkSensitiveWord(string $checkString)
    {
        return $this->handler->checkSensitiveWord($checkString);
    }
}
