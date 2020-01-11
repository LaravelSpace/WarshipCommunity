<?php

namespace App\Service\User\Model;


use Illuminate\Database\Eloquent\Model;

class TokenModel extends Model
{
    protected $connection = 'mysql';

    protected $table = 'token';

    protected $fillable = [
        'client',
        'client_id',
        'access_token',
        'expires_at',
        'refresh_token',
        'scope',
    ];

    protected $dates = ['expires_at'];
}
