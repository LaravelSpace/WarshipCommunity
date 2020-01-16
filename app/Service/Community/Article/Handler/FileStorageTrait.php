<?php

namespace App\Service\Community\Article\Handler;


trait FileStorageTrait
{
    /**
     * @param string $dirPath
     * @param string $key
     * @param string $body
     * @return bool|int
     * @throws \App\Exceptions\ServiceException
     */
    public function saveToFile(string $dirPath, string $key, string $body)
    {
        try {
            // 创建目录
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            // 记录文本
            return file_put_contents($dirPath . $key . '.txt', $body);
        } catch (\Exception $e) {
            $filePath = config('constant.file_path.exception') . $key . '.log';
            $timeText = PHP_EOL . 'TIME IS:' . dateTimeNow() . PHP_EOL;
            $eText = 'ECode=' . $e->getCode() . PHP_EOL . 'EMessage=' . $e->getMessage() . PHP_EOL;
            $eTrace = $e->getTraceAsString() . PHP_EOL;
            $text = $timeText . $eText . $eTrace . $body . PHP_EOL;
            file_put_contents($filePath, $text);
        }
        renderServiceException('save_to_file_failed');

        return false;
    }

    /**
     * @param string $dirPath
     * @param string $key
     * @return bool|string
     * @throws \App\Exceptions\ServiceException
     */
    public function getFromFile(string $dirPath, string $key)
    {
        try {
            return file_get_contents($dirPath . $key . '.txt');
        } catch (\Exception $e) {
            $filePath = config('constant.file_path.exception') . $key . '.log';
            $timeText = PHP_EOL . 'TIME IS:' . dateTimeNow() . PHP_EOL;
            $eText = 'ECode=' . $e->getCode() . PHP_EOL . 'EMessage=' . $e->getMessage() . PHP_EOL;
            $eTrace = $e->getTraceAsString() . PHP_EOL;
            $text = $timeText . $eText . $eTrace;
            file_put_contents($filePath, $text);
        }
        renderServiceException('get_from_file_failed');

        return false;
    }
}
