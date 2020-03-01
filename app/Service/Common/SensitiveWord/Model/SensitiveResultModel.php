<?php

namespace App\Service\Common\SensitiveWord\Model;


use Illuminate\Database\Eloquent\Model;


class SensitiveResultModel extends Model
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
