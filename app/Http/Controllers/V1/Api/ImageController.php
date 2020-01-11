<?php

namespace App\Http\Controllers\V1\Api;


use App\Http\Controllers\V1\ApiControllerAbstract;
use App\Service\Common\Image\ImageService;
use Illuminate\Http\Request;

class ImageController extends ApiControllerAbstract
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ValidateException
     */
    public function store(Request $request)
    {
        $imageFile = $request->input('image_file');
        $imageType = $request->input('image_type');
        $user = ['id' => 4];

        $result = (new ImageService())->createImage($user, $imageFile, $imageType);

        return $this->response($result);
    }

    public function listUserImage(Request $request)
    {
        $userId = $request->input('user_id');
        $user = ['id' => $userId];

        $result = (new ImageService())->listImage($user);

        return $this->response($result);
    }
}
