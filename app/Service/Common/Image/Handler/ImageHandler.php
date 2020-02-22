<?php

namespace App\Service\Common\Image\Handler;


use App\Service\Common\Image\Model\ImageModel;

class ImageHandler
{
    /**
     * 生成 base64 格式的图片
     *
     * @param int   $userId
     * @param       $imageFile
     * @return array
     */
    public function createImageBase64(int $userId, $imageFile)
    {
        $image = str_replace('data:image/jpeg;base64,', '', $imageFile);
        $imageName = gMakeUniqueKey32() . "-{$userId}.jpeg";
        $dirPath = storage_path() . config('constant.file_path.image_storage');
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0755, true);
        }
        file_put_contents($dirPath . $imageName, base64_decode($image));
        $createField = ['name' => $imageName, 'image_type' => 'upload', 'user_id' => $userId];
        $dbImage = ImageModel::create($createField);

        return [
            'id'  => $dbImage->id,
            'url' => config('constant.file_path.image_public') . $imageName,
        ];
    }
}
