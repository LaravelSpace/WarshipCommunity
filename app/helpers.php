<?php

if (!function_exists('gMakeUniqueKey32')) {
    /**
     * 生成 32 位唯一字符串 ID
     *
     * @return string
     */
    function gMakeUniqueKey32()
    {
        return md5(uniqid(microtime(), true));
        // microtime() 返回当前 Unix 时间戳的微秒数
        // uniqid() 获取一个带前缀、基于当前时间微秒数的唯一 ID
        // md5() 计算字符串的 MD5 散列值并以 32 字符十六进制数字形式返回散列值
    }
}

if (!function_exists('gDateTimeNow')) {
    /**
     * 返回当前时间 Y-m-d H:i:s
     *
     * @return false|string
     */
    function gDateTimeNow()
    {
        return date('Y-m-d H:i:s', time());
    }
}

if (!function_exists('gDateTimeCreate')) {
    /**
     * 使用 time 创建当前时间 Y-m-d H:i:s
     *
     * @param int $time
     * @return false|string
     */
    function gDateTimeCreate(int $time)
    {
        return date('Y-m-d H:i:s', $time);
    }
}

if (!function_exists('gDateNow')) {
    /**
     * 返回当前日期 Y-m-d
     *
     * @return false|string
     */
    function gDateNow()
    {
        return date('Y-m-d', time());
    }
}

if (!function_exists('gDateCreate')) {
    /**
     * 使用 time 创建当前日期 Y-m-d
     *
     * @param int $time
     * @return false|string
     */
    function gDateCreate(int $time)
    {
        return date('Y-m-d', $time);
    }
}

if (!function_exists('gRenderServiceException')) {
    /**
     * 抛出业务异常，默认错误码 400
     *
     * @param string $message
     * @param int    $code
     * @param string $attachment
     * @throws \App\Exceptions\ServiceException
     */
    function gRenderServiceException($message = "", $code = 400, $attachment = "")
    {
        $messageConfig = config('message');
        if (array_key_exists($message, $messageConfig)) {
            $messageValue = $messageConfig[$message];
        } else {
            $messageValue = $message;
        }
        throw new \App\Exceptions\ServiceException($messageValue, $code, $attachment);
    }
}

if (!function_exists('gRenderValidationException')) {
    /**
     * 抛出效验异常，默认错误码 422
     *
     * @param string $message
     * @param int    $code
     * @param string $attachment
     * @throws \App\Exceptions\ValidationException
     */
    function gRenderValidationException($message = "", $code = 422, $attachment = "")
    {
        $messageConfig = config('message');
        if (array_key_exists($message, $messageConfig)) {
            $messageValue = $messageConfig[$message];
        } else {
            $messageValue = $message;
        }
        throw new \App\Exceptions\ValidationException($messageValue, $code, $attachment);
    }
}

if (!function_exists('gSaveExceptionToFile')) {
    /**
     * 将异常存储到文件
     * 文件名和原本应该产生的文件保持一致，方便查找
     *
     * @param string    $fileName [文件名]
     * @param Exception $e        [异常实例]
     */
    function gSaveExceptionToFile(string $fileName, Exception $e)
    {
        $filePath = config('constant.file_path.log_exception') . $fileName;
        $filePath = storage_path($filePath);
        dd($filePath);
        $timeText = PHP_EOL . 'TIME IS:' . gDateTimeNow();
        $eText = PHP_EOL . 'ECode=' . $e->getCode() . PHP_EOL . 'EMessage=' . $e->getMessage();
        $eTrace = PHP_EOL . $e->getTraceAsString();
        $text = $timeText . $eText . $eTrace;
        file_put_contents($filePath, $text, FILE_APPEND);
    }
}
