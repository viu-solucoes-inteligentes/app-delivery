<?php

namespace ApiDelivery\Models;

use ApiDelivery\Notifications\changeResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * ApiDelivery\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiDelivery\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements Transformable
{
    use TransformableTrait;
    use Notifiable;
    use SoftDeletes;

    const ROLE_ADMIN = 1;
    const ROLE_CLIENT = 2;



    /**
     * Opcional, informar a coluna deleted_at como um Mutator de data
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'description'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new changeResetPassword($token));
    }

    public function client(){
        return $this->hasOne(Client::class);
    }


    public function orders(){
        return $this->hasMany(Order::class);
    }

}
