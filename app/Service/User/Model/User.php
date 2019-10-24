<?php

namespace App\Service\User\Model;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Service\User\Model\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $phone
 * @property string|null $phone_verified_at
 * @property string $password
 * @property string|null $avatar
 * @property string $api_token
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User wherePhoneVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Service\User\Model\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 密码字段预处理
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password); // 密码加密
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
