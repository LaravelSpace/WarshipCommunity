<?php

namespace App\Community\Management\Handler;


use App\Community\Management\Model\Role;

class RoleHandler
{
    public function roleList(array $inputData)
    {
        $roleList = Role::get();
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
        $role = Role::create($roleData);
        $returnData = [
            'status' => config('constant.success'),
            'data'   => $role->toArray()
        ];

        return $returnData;
    }
}
