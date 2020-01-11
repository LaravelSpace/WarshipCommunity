<?php

namespace App\Service\Common\SensitiveWord\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Service\Common\SensitiveWord\Model\SensitiveResult
 *
 * @property int $id
 * @property string $classification
 * @property int $target_id
 * @property string|null $result_data
 * @property \Illuminate\Support\Carbon $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereClassification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereResultData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\SensitiveWord\Model\SensitiveResult whereTargetId($value)
 * @mixin \Eloquent
 */
class SensitiveResult extends Model
{
    protected $connection = 'mysql';

    protected $table = 'sensitive_result';

    protected $fillable = [
        'classification',
        'target_id',
        'result_data',
    ];
}
