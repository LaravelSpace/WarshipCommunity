<?php

namespace App\Service\User\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * App\Service\User\Model\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $describe
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role whereDescribe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    protected $connection = 'mysql';

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'describe'
    ];
}
