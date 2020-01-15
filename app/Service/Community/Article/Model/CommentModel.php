<?php

namespace App\Service\Community\Article\Model;


use App\Service\User\Model\UserModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommentModel extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'comment';

    protected $fillable = [
        'body',
        'user_id',
        'article_id',
        'article_floor',
        'examine',
        'blacklist',
        'star_num',
    ];

    public function scopePassExamine(Builder $query)
    {
        $query->where('examine', '=', 1); // 通过敏感词审核
    }

    public function scopeNotInBlacklist(Builder $query)
    {
        $query->where('blacklist', '=', false); // 不在黑名单中
    }

    public function article()
    {
        return $this->belongsTo(ArticleModel::class);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
