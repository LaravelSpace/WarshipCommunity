<?php

namespace App\Service\Community\Article\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Service\Community\Article\Model\Comment
 *
 * @property int $id
 * @property string $main_body
 * @property int $user_id
 * @property int $article_id
 * @property int $examine
 * @property int $blacklist
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereBlacklist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereExamine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereMainBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereUserId($value)
 * @mixin \Eloquent
 * @property string $body
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment notInBlacklist()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment passExamine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Comment whereBody($value)
 */
class Comment extends Model
{
    protected $connection = 'mysql';

    protected $table = 'comments';

    protected $fillable = [
        'body',
        'user_id',
        'article_id'
    ];

    public function scopePassExamine($query)
    {
        $query->where('examine', '=', 2); // 通过敏感词审核
    }

    public function scopeNotInBlacklist($query)
    {
        $query->where('blacklist', '=', false); // 不在黑名单中
    }
}
