<?php

namespace App\Service\Community\Assess\Model;


use Illuminate\Database\Eloquent\Model;

class StarModel extends Model
{
    protected $connection = 'mysql';

    protected $table = 'star';

    protected $fillable = [
        'user_id',
        'classification',
        'target_id',
    ];

    public $timestamps = false;
}
