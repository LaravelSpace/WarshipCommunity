<?php

namespace App\Service\Community\Article\Model;


use App\Service\User\Model\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Service\Community\Article\Model\Article
 *
 * @property int                               $id
 * @property string                            $title
 * @property string                            $main_body
 * @property int                               $user_id
 * @property int                               $examine
 * @property int                               $blacklist
 * @property string|null                       $deleted_at
 * @property \Illuminate\Support\Carbon        $created_at
 * @property \Illuminate\Support\Carbon        $updated_at
 * @property-read \App\Service\User\Model\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article notInBlacklist()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article passExamine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereBlacklist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereExamine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereMainBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereUserId($value)
 * @mixin \Eloquent
 * @property string                            $body
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Community\Article\Model\Article whereBody($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Service\Community\Article\Model\Article onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Service\Community\Article\Model\Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Service\Community\Article\Model\Article withoutTrashed()
 */
class Article extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'body',
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
