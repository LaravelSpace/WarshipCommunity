<?php

namespace App\Community\Management\Model;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $connection = 'mysql';

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'describe'
    ];
}