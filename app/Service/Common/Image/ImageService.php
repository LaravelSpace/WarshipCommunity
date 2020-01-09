<?php

namespace App\Service\Common\Image;


use App\Service\Common\Image\Model\Image;

class ImageService
{
    public function listImage(array $user)
    {
        $dbImageList = Image::query()->where(['user_id' => $user['id'],'image_type' => 'upload'])->get();
        $imageList = [];
        foreach ($dbImageList as $item){
            $imageList[] = [
                'image_url' => '/storage/image/upload/' . $item->name
            ];
        }

        return $imageList;
    }

    public function createImageBase64(array $user, $imageBase64)
    {
        $image = str_replace('data:image/jpeg;base64,', '', $imageBase64);
        $imageName = makeUniqueKey32() . '-' . $user['id'] . '.jpeg';
        $dirPath = storage_path() . '/app/public/image/upload/';
        if (!is_dir($dirPath)) {
            mkdir($dirPath, 0755, true);
        }
        file_put_contents($dirPath . $imageName, base64_decode($image));
        Image::query()->create(['name' => $imageName, 'image_type' => 'upload', 'user_id' => $user['id']]);

        return ['image_url' => '/storage/image/upload/' . $imageName];
    }
}
