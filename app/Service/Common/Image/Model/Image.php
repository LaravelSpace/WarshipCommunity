<?php

namespace App\Service\Common\Image\Model;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $connection = 'mysql';

    protected $table = 'image';

    protected $fillable = [
        'name',
        'image_type',
        'user_id',
    ];

    public $timestamps = false;
}
