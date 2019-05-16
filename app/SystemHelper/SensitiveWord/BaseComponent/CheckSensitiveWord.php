<?php

namespace App\SystemHelper\SensitiveWord\BaseComponent;


interface CheckSensitiveWord
{
    /**
     * 校验字符串里是否有敏感词并返回匹配到的结果
     *
     * @param string $checkString
     *
     * @return array
     */
    public function checkSensitiveWord(string $checkString);
}
