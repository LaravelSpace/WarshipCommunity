<?php

namespace App\Service\Common\Log;


class LogService
{
    /**
     * @param string $dirPath [存储目录]
     * @param string $key     [日志标识]
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
                $filePath = config('constant.file_path.log_exception') . $fileName;
                $filePath = storage_path($filePath);
                $eText = PHP_EOL . 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
                $text = PHP_EOL . 'TIME IS:' . gDateTimeNow() . PHP_EOL . $eText . PHP_EOL . $e->getTraceAsString();
                file_put_contents($filePath, $text, FILE_APPEND);
            }
        } catch (\Exception $e) {
            $filePath = config('constant.file_path.log_exception') . $fileName;
            $filePath = storage_path($filePath);
            $eText = PHP_EOL . 'ECode=' . $e->getCode() . PHP_EOL . 'EMessage=' . $e->getMessage();
            $text = PHP_EOL . 'TIME IS:' . gDateTimeNow() . PHP_EOL . $eText . PHP_EOL . $e->getTraceAsString();
            file_put_contents($filePath, $text, FILE_APPEND);
        }
    }
}
