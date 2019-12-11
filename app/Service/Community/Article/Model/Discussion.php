<?php

namespace App\Service\Community\Article\Model;


use App\Service\User\Model\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'discussion';

    protected $fillable = [
        'body',
        'user_id',
        'comment_id',
        'examine',
        'blacklist',
        'star_num',
    ];

    public function scopePassExamine(Builder $query)
    {
        $query->where('examine', '=', 2); // 通过敏感词审核
    }

    public function scopeNotInBlacklist(Builder $query)
    {
        $query->where('blacklist', '=', false); // 不在黑名单中
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
