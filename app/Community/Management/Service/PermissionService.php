<?php

namespace App\Community\Management\Service;


use App\Community\Management\Handler\PermissionHandler;
use App\Community\Management\Handler\RoleHandler;
use App\Exceptions\ValidateException;

class PermissionService
{
    /**
     * @param array  $inputData
     * @param string $classification
     * @return mixed
     * @throws ValidateException
     */
    public function dataHandler(array $inputData, string $classification)
    {
        switch ($classification) {
            case 'permissionList':
                $handler = new PermissionHandler();
                $resultData = $handler->permissionList($inputData);
                break;
            case 'permissionStore':
                $handler = new PermissionHandler();
                $resultData = $handler->permissionStore($inputData);
                break;
            case 'roleList':
                $handler = new RoleHandler();
                $resultData = $handler->roleList($inputData);
                break;
            case 'roleStore':
                $handler = new RoleHandler();
                $resultData = $handler->roleStore($inputData);
                break;
            default:
                $message = ValidateException::SWITCH_NON_EXISTENT_CASE . 'CASE=' . $classification;
                throw new ValidateException($message, config('constant.http_code_500'));
        }
        return $resultData;
    }
}
