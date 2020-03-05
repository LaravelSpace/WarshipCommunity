<?php

namespace App\Service\User\Model;


use Illuminate\Database\Eloquent\Model;

class SignCalendarModel extends Model
{
    protected $connection = 'mysql';

    protected $table = 'sign_calendar';

    protected $fillable = [
        'user_id',
        'sign_date',
        'created_at',
    ];

    public $timestamps = false;
}