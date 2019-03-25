<?php

namespace App\Community\Article\Model;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $connection = 'mysql';

    protected $table = 'community_comments';

    protected $fillable = [
        'main_body',
        'user_id',
        'article_id',
    ];
}
