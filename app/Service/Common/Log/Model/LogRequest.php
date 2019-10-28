<?php

namespace App\Service\Common\Log\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Service\Common\Log\Model\LogRequest
 *
 * @property int $id
 * @property string $ip
 * @property string $url
 * @property string $request
 * @property string $response
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereRequest($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereUrl($value)
 * @mixin \Eloquent
 * @property string $client_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\Common\Log\Model\LogRequest whereClientId($value)
 */
class LogRequest extends Model
{
    protected $connection = 'mysql';

    protected $table = 'log_request';

    protected $fillable = [
        'ip',
        'client_id',
        'url',
        'request',
        'response'
    ];
}
