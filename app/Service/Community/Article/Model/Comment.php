<?php

namespace App\Service\Community\Article\Model;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'comments';

    protected $fillable = [
        'body',
        'user_id',
        'article_id'
    ];

    public function scopePassExamine(Builder $query)
    {
        $query->where('examine', '=', 2); // 通过敏感词审核
    }

    public function scopeNotInBlacklist(Builder $query)
    {
        $query->where('blacklist', '=', false); // 不在黑名单中
    }
}
