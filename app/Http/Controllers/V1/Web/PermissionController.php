<?php

namespace App\Http\Controllers\V1\Web;


use App\Exceptions\ValidateException;
use App\Http\Controllers\V1\WebController;
use App\Service\User\Service\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends WebController
{
    public function indexPermission(Request $request)
    {
        $inputData = $request->all();
        if (isset($inputData['data']) && $inputData['data'] === '1') {
            return $this->dataHandler($inputData, 'permissionList');
        } else {
            return view('community.management.permission');
        }
    }

    public function storePermission(Request $request)
    {
        $inputData = $request->all();

        return $this->dataHandler($inputData, 'permissionStore');
    }

    public function indexRole(Request $request)
    {
        $inputData = $request->all();
        if (isset($inputData['data']) && $inputData['data'] === '1') {
            return $this->dataHandler($inputData, 'roleList');
        } else {
            return view('community.management.permission');
        }
    }

    public function storeRole(Request $request)
    {
        $inputData = $request->all();

        return $this->dataHandler($inputData, 'roleStore');
    }

    public function dataHandler(array $inputData, string $classification)
    {
        $service = new PermissionService();
        try {
            $resultData = $service->dataHandler($inputData, $classification);

            return $this->response($resultData);
        } catch (ValidateException $exception) {
            return $this->setStatusCode($exception->getCode())
                ->responseError($exception->getCode(), $exception->getMessage());
        }
    }
}
