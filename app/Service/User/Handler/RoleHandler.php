<?php

namespace App\Service\User\Handler;


use App\Service\User\Model\RoleModel;

class RoleHandler
{
    public function roleList(array $inputData)
    {
        $roleList = RoleModel::get();
        if ($roleList->count() > 0) {
            $roleList = $roleList->toArray();
        } else {
            $roleList = [];
        }
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $roleList
        ];

        return $returnData;
    }

    public function roleStore(array $inputData)
    {
        $roleData = [
            'name'     => $inputData['name'],
            'describe' => $inputData['describe']
        ];
        $role = RoleModel::create($roleData);
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $role->toArray()
        ];

        return $returnData;
    }
}
