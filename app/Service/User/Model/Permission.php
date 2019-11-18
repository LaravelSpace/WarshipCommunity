<?php

namespace App\Service\User\Model;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $connection = 'mysql';

    protected $table = 'permission';

    protected $fillable = [
        'name',
        'describe'
    ];
}
