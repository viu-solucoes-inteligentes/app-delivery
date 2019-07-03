<?php

namespace ApiDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiDelivery\Repositories\ProductRepository;
use ApiDelivery\Models\Product;
use ApiDelivery\Validators\ProductValidator;

/**
 * Class ProductRepositoryEloquent.
 *
 * @package namespace ApiDelivery\Repositories;
 */
class ProductRepositoryEloquent extends BaseRepository implements ProductRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        'name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Product::class;
    }

    public function onlyTrashed()
    {
        $this->model = $this->model->onlyTrashed();
        return $this;
    }

    public function restore($id)
    {
        return $this->model->onlyTrashed()->find($id)->restore();
    }
    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProductValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
