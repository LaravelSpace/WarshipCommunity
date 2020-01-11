<?php

namespace App\Service\Common\Log\Model;


use Illuminate\Database\Eloquent\Model;

class LogRequestModel extends Model
{
    protected $connection = 'mysql';

    protected $table = 'log_request';

    protected $fillable = [
        'ip',
        'client',
        'client_id',
        'uri',
        'request',
        'response',
        'consumption',
    ];
}
