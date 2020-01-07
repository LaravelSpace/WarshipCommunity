<?php

namespace App\Service\Common\Image;


class ImageService
{
    public function createImageBase64(array $user, $imageBase64)
    {
        $imgge = str_replace('data:image/jpeg;base64,', '', $imageBase64);
        file_put_contents('/image.jpeg', base64_decode($imgge));
        dd(1);
    }
}
