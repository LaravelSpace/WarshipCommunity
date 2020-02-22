<?php

namespace App\Service\Community\Article\Handler;


trait FileStorageTrait
{
    /**
     * @param string $dirPath [存储目录]
     * @param string $key     [文件标识]
     * @param string $body    [文件内容]
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
            gSaveExceptionToFile($key, $e);
        }
        gRenderServiceException('save_to_file_failed');

        return false;
    }

    /**
     * @param string $dirPath [存储目录]
     * @param string $key     [文件标识]
     * @return bool|string
     * @throws \App\Exceptions\ServiceException
     */
    public function getFromFile(string $dirPath, string $key)
    {
        try {
            return file_get_contents($dirPath . $key . '.txt');
        } catch (\Exception $e) {
            gSaveExceptionToFile($key, $e);
        }
        gRenderServiceException('get_from_file_failed');

        return false;
    }
}
