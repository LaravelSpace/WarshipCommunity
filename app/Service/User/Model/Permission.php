<?php

namespace App\Service\User\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Service\User\Model\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $describe
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission whereDescribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends Model
{
    protected $connection = 'mysql';

    protected $table = 'permissions';

    protected $fillable = [
        'name',
        'describe'
    ];
}
