<?php

namespace ApiDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Client.
 *
 * @package namespace ApiDelivery\Models;
 */
class Client extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'address', 'city', 'state', 'zipcode', 'phone', 'email', 'website', 'status', 'user_id'];

    function user(){
        return $this->belongsTo(User::class);
    }
}
