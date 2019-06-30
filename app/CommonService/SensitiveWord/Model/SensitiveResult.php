<?php

namespace App\CommonService\SensitiveWord\Model;


use Illuminate\Database\Eloquent\Model;

class SensitiveResult extends Model
{
    protected $connection = "mysql";

    protected $table = "sensitive_results";

    protected $fillable = [
        "target_id",
        "classification",
        "result_data",
    ];
}
