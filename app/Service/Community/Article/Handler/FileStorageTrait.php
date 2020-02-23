<?php

namespace App\Service\Community\Article\Handler;


trait FileStorageTrait
{
    /**
     * 将内容保存到文件
     *
     * @param string $dirPath  [存储目录]
     * @param string $fileName [文件名]
     * @param string $body     [文件内容]
     * @return bool|int
     * @throws \App\Exceptions\ServiceException
     */
    public function saveToFile(string $dirPath, string $fileName, string $body)
    {
        try {
            // 创建目录
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            // 记录文本
            $filePath = $dirPath . $fileName;
            // 用覆盖的方式写入文件
            return file_put_contents($filePath, $body);
        } catch (\Exception $e) {
            gSaveExceptionToFile($fileName, $e);
        }
        gRenderServiceException('save_to_file_failed');

        return false;
    }

    /**
     * 从文件中读取内容
     *
     * @param string $dirPath  [存储目录]
     * @param string $fileName [文件名]
     * @return bool|string
     * @throws \App\Exceptions\ServiceException
     */
    public function getFromFile(string $dirPath, string $fileName)
    {
        try {
            return file_get_contents($dirPath . $fileName);
        } catch (\Exception $e) {
            gSaveExceptionToFile($fileName, $e);
        }
        gRenderServiceException('get_from_file_failed');

        return false;
    }
}
