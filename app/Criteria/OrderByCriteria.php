<?php

namespace ApiDelivery\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderByCriteria.
 *
 * @package namespace ApiDelivery\Criteria;
 */
class OrderByCriteria implements CriteriaInterface
{

    private $order;

    function __construct($order)
    {
        $this->order = $order;
    }
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {

        $m = $model->orderBy($this->order['type'],$this->order['order'] );
        return $m;
    }
}
