<?php

namespace App\Service\Common\Image\Handler;


use App\Service\Common\Image\Model\ImageModel;

class ImageHandler
{
    /**
     * 生成 base64 格式的图片
     *
     * @param array $user
     * @param       $imageFile
     * @return array
     */
    public function createImageBase64(array $user, $imageFile)
    {
        $image = str_replace('data:image/jpeg;base64,', '', $imageFile);
        $imageName = makeUniqueKey32() . "-{$user['id']}.jpeg";
        $dirPath = storage_path() . config('constant.image_path.storage');
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0755, true);
        }
        file_put_contents($dirPath . $imageName, base64_decode($image));
        $createField = ['name' => $imageName, 'image_type' => 'upload', 'user_id' => $user['id']];
        $dbImage = ImageModel::query()->create($createField);

        return [
            'id'  => $dbImage->id,
            'url' => config('constant.image_path.public') . $imageName,
        ];
    }
}
