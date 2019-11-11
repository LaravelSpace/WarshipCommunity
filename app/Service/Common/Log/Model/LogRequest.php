<?php

namespace App\Service\Common\Log\Model;


use Illuminate\Database\Eloquent\Model;

class LogRequest extends Model
{
    protected $connection = 'mysql';

    protected $table = 'log_request';

    protected $fillable = [
        'ip',
        'client',
        'uri',
        'request',
        'response'
    ];
}
