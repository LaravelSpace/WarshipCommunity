<?php

if (!function_exists('makeUniqueKey32')) {
    /**
     * 生成 32 位唯一字符串 ID
     *
     * @return string
     */
    function makeUniqueKey32()
    {
        return md5(uniqid(microtime(), true));
        // microtime() 返回当前 Unix 时间戳的微秒数
        // uniqid() 获取一个带前缀、基于当前时间微秒数的唯一 ID
        // md5() 计算字符串的 MD5 散列值并以 32 字符十六进制数字形式返回散列值
    }
}

if (!function_exists('dateNow')) {
    /**
     * 返回当前日期 Y-m-d
     *
     * @return false|string
     */
    function dateNow()
    {
        return date('Y-m-d', time());
    }
}

if (!function_exists('dateCreate')) {
    /**
     * 使用 time 创建当前日期 Y-m-d
     *
     * @param int $time
     * @return false|string
     */
    function dateCreate(int $time)
    {
        return date('Y-m-d', $time);
    }
}

if (!function_exists('timeNow')) {
    /**
     * 返回当前时间 Y-m-d H:i:s
     *
     * @return false|string
     */
    function timeNow()
    {
        return date('Y-m-d H:i:s', time());
    }
}

if (!function_exists('timeCreate')) {
    /**
     * 使用 time 创建当前时间 Y-m-d H:i:s
     *
     * @param int $time
     * @return false|string
     */
    function timeCreate(int $time)
    {
        return date('Y-m-d H:i:s', $time);
    }
}

if (!function_exists('renderServiceException')) {
    /**
     * 抛出业务异常
     *
     * @param string $message
     * @param int    $code
     * @param string $attachment
     * @throws \App\Exceptions\ServiceException
     */
    function renderServiceException($message = "", $code = 0, $attachment = "")
    {
        throw new \App\Exceptions\ServiceException($message, $code, $attachment);
    }
}
