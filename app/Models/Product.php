<?php

namespace ApiDelivery\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Product.
 *
 * @package namespace ApiDelivery\Models;
 */
class Product extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

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
    protected $fillable = ['name', 'description', 'price', 'category_id', 'filename', 'filetype', 'filesize'];

    function category(){
        return $this->belongsTo(Category::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
