<?php

namespace App\Service\User\Model;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'mysql';

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'describe'
    ];
}
