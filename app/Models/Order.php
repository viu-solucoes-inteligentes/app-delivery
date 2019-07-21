<?php

namespace ApiDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace ApiDelivery\Models;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'user_id', 'product_id'];

    function user(){
        return $this->belongsTo(User::class);
    }

    function product(){
        return $this->belongsTo(Product::class);
    }
}
