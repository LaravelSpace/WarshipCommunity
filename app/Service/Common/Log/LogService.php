<?php

namespace App\Service\Common\Log;


class LogService
{
    /**
     * @param string $dirPath
     * @param string $key
     * @param mixed  $data
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
                    $text = "\nTIME IS:" . timeNow() . "\n" . json_encode($data) . "\n";
                } else {
                    $text = "\nTIME IS:" . timeNow() . "\n" . var_export($data, true) . "\n";
                }
                file_put_contents($filePath, $text, FILE_APPEND);
            } catch (\Exception $e) {
                $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
                $text = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
                file_put_contents($filePath, $text, FILE_APPEND);
            }
        } catch (\Exception $e) {
            $filePath = config('constant.file_path.exception') . $fileName;
            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $text = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
            file_put_contents($filePath, $text, FILE_APPEND);
        }
    }
}
