<?php

namespace App\Service\Common\Notification\Model;


use Illuminate\Database\Eloquent\Model;

class PrivateChannelModel extends Model
{
    protected $connection = 'mysql';

    protected $table = 'sensitive_result';

    protected $fillable = [
        'classification',
        'target_id',
        'result_data',
    ];

    public $timestamps = false;
}