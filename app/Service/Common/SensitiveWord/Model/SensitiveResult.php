<?php

namespace App\Service\Common\SensitiveWord\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Service\Common\SensitiveWord\Model\SensitiveResult
 *
 * @property int $id
 * @property int $target_id
 * @property string $classification
 * @property string $result_data
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereResultData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereTargetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
