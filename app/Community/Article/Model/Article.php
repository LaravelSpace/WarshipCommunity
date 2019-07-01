<?php

namespace App\Community\Article\Model;


use App\Community\User\Model\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $connection = "mysql";

    protected $table = "community_articles";

    protected $fillable = [
        "title",
        "main_body",
        "user_id",
        "examine",
        "blacklist",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePassExamine($query)
    {
        $query->where("examine", '=', 2);
    }

    public function scopeNotInBlacklist($query)
    {
        $query->where("blacklist", '=', false);
    }
}
