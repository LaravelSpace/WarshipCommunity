<?php

namespace App\Service\Community\Article\Model;


use Illuminate\Database\Eloquent\Model;

class BookmarkModel extends Model
{
    protected $connection = 'mysql';

    protected $table = 'bookmark';

    protected $fillable = [
        'user_id',
        'classification',
        'target_id',
    ];
}
