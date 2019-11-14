<?php

namespace App\Service\Common\Log;


class LogService
{
    /**
     * @param string $dirPath
     * @param string $filePath
     * @param mixed  $data
     */
    public function saveToFile(string $dirPath, string $filePath, $data)
    {
        // 创建目录
        try {
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777, true);
            }
            // 记录日志
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
            $fileName = makeUniqueKey32();
            $filePath = '/temp/log/exception/' . $fileName . '.log';
            $eText = 'ECode=' . $e->getCode() . ',EMessage=' . $e->getMessage();
            $text = "\nTIME IS:" . timeNow() . "\n{$eText}\n" . $e->getTraceAsString() . "\n";
            file_put_contents($filePath, $text, FILE_APPEND);
        }
    }
}
