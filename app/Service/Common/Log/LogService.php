<?php

namespace App\Service\Common\Log;


class LogService
{
    /**
     * @param string $dirPath [存储目录]
     * @param string $key     [文件名]
     * @param mixed  $data    [日志内容]
     */
    public function saveToFile(string $dirPath, string $key, $data)
    {
        $fileName = $key . '.log';
        // 创建目录
        try {
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            // 记录日志
            $filePath = $dirPath . $fileName;
            try {
                if (is_array($data)) {
                    $text = PHP_EOL . 'TIME IS:' . gDateTimeNow() . PHP_EOL . json_encode($data);
                } else {
                    $text = PHP_EOL . 'TIME IS:' . gDateTimeNow() . PHP_EOL . var_export($data, true);
                }
                file_put_contents($filePath, $text, FILE_APPEND);
            } catch (\Exception $e) {
                gSaveExceptionToFile($fileName, $e);
            }
        } catch (\Exception $e) {
            gSaveExceptionToFile($fileName, $e);
        }
    }
}
