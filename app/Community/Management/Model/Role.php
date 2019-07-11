<?php

namespace App\Community\Management\Model;


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
