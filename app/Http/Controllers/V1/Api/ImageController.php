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
     * @throws \App\Exceptions\ValidationException
     */
    public function create(Request $request)
    {
        $imageFile = $request->input('image_file');
        $imageType = $request->input('image_type');
        $userId = config('client_id');

        $result = (new ImageService())->createImage($userId, $imageFile, $imageType);

        return $this->response($result);
    }

    public function listUserImage(Request $request)
    {
        $userId = config('client_id');

        $result = (new ImageService())->listImage($userId);

        return $this->response($result);
    }
}
