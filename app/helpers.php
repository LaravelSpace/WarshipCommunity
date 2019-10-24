<?php

function makeUniqueKey32()
{
    return md5(uniqid(microtime(), true));
    // microtime() 返回当前 Unix 时间戳的微秒数
    // uniqid() 获取一个带前缀、基于当前时间微秒数的唯一 ID。
    // md5() 计算字符串的 MD5 散列值并以 32 字符十六进制数字形式返回散列值
}

function dateToday()
{
    return date('Y-m-d', time());
}

function timeNow()
{
    return date('Y-m-d H:i:s', time());
}
