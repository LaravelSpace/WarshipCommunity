<?php

namespace App\Service\User\Model;


use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $connection = 'mysql';

    protected $table = 'role';

    protected $fillable = [
        'name',
        'describe',
    ];
}
