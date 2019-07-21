<?php

namespace ApiDelivery\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiDelivery\Repositories\OrderRepository;
use ApiDelivery\Models\Order;
use ApiDelivery\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace ApiDelivery\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
