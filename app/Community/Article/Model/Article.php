<?php

namespace App\Community\Article\Model;


use App\Community\User\Model\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $connection = 'mysql';

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'main_body',
        'user_id',
        'examine',
        'blacklist'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePassExamine($query)
    {
        $query->where('examine', '=', 2); // 通过敏感词审核
    }

    public function scopeNotInBlacklist($query)
    {
        $query->where('blacklist', '=', false); // 不在黑名单中
    }
}
