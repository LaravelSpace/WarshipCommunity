<?php

namespace App\Community\Article\Model;


use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $connection = 'mysql';

    protected $table = 'community_articles';

    protected $fillable = [
        'title',
        'main_body',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
