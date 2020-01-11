<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\PermissionModel;

class PermissionHandler
{
    public function permissionList(array $inputData)
    {
        $permissionList = PermissionModel::get();
        if ($permissionList->count() > 0) {
            $permissionList = $permissionList->toArray();
        } else {
            $permissionList = [];
        }
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $permissionList
        ];

        return $returnData;
    }

    public function permissionStore(array $inputData)
    {
        $permissionData = [
            'name'     => $inputData['name'],
            'describe' => $inputData['describe']
        ];
        $permission = PermissionModel::create($permissionData);
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $permission->toArray()
        ];

        return $returnData;
    }
}
