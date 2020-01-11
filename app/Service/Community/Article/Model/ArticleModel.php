<?php

namespace App\Service\Community\Article\Model;


use App\Service\User\Model\UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleModel extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'article';

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'examine',
        'blacklist',
        'mention_num',
        'star_num',
        'bookmark_num',
    ];

    public function scopePassExamine(Builder $query)
    {
        $query->where('examine', '=', 2); // 通过敏感词审核
    }

    public function scopeNotInBlacklist(Builder $query)
    {
        $query->where('blacklist', '=', false); // 不在黑名单中
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
