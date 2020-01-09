<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Service\Common\Image\ImageService;
use Illuminate\Http\Request;

class ImageController extends ApiControllerAbstract
{
    public function store(Request $request)
    {
        $imageBase64 = $request->input('image_base64');
        $user = ['id' => 4];

        $result = (new ImageService())->createImageBase64($user, $imageBase64);

        return $this->response($result);
    }

    public function listUserImage(Request $request){
        $userId = $request->input('user_id');
        $user = ['id' => $userId];

        $result = (new ImageService())->listImage($user);

        return $this->response($result);
    }
}
