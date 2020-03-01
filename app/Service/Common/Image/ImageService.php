<?php

namespace App\Service\Common\Image;


use App\Service\Common\Image\Handler\ImageHandler;
use App\Service\Common\Image\Model\ImageModel;

class ImageService
{
    /**
     * 获取图片列表
     *
     * @param int $userId
     * @return array
     */
    public function listImage(int $userId)
    {
        $dbImageList = ImageModel::where(['user_id' => $userId, 'image_type' => 'upload'])->get();
        $imageList = [];
        foreach ($dbImageList as $item) {
            $imageList[] = [
                'id'  => $item->id,
                'url' => '/storage/image/upload/' . $item->name
            ];
        }
        return $imageList;
    }

    /**
     * 生成图片
     *
     * @param int    $userId
     * @param        $imageFile
     * @param string $imageType
     * @return array
     * @throws \App\Exceptions\ValidationException
     */
    public function createImage(int $userId, $imageFile, string $imageType)
    {
        if ($imageType === 'base64') {
            return (new ImageHandler())->createImageBase64($userId, $imageFile);
        } else {
            gRenderValidationException('image_type_not_exist');
        }
        return [];
    }
}
