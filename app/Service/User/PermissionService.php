<?php

namespace App\Service\User;


use App\Exceptions\ValidationException;
use App\Service\User\Handler\PermissionHandler;
use App\Service\User\Handler\RoleHandler;

class PermissionService
{
    /**
     * @param array  $inputData
     * @param string $classification
     * @return mixed
     * @throws ValidationException
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
                $message = ValidationException::SWITCH_NON_EXISTENT_CASE . 'CASE=' . $classification;
                throw new ValidationException($message, config('constant.http_code_500'));
        }
        return $resultData;
    }
}
