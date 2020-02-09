<?php

namespace App\Service\Common\Image;


use App\Service\Common\Image\Handler\ImageHandler;
use App\Service\Common\Image\Model\ImageModel;

class ImageService
{
    /**
     * 获取图片列表
     *
     * @param array $user
     * @return array
     */
    public function listImage(array $user)
    {
        $dbImageList = ImageModel::where(['user_id' => $user['id'], 'image_type' => 'upload'])->get();
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
     * @param array  $user
     * @param        $imageFile
     * @param string $imageType
     * @return array
     * @throws \App\Exceptions\ValidateException
     */
    public function createImage(array $user, $imageFile, string $imageType)
    {
        if ($imageType === 'base64') {
            return (new ImageHandler())->createImageBase64($user, $imageFile);
        } else {
            renderValidateException('image_type_not_exist');
        }
        return [];
    }
}
