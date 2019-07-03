<?php

namespace ApiDelivery\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SearchWithJoinCriteria.
 *
 * @package namespace ApiDelivery\Criteria;
 */
class SearchWithJoinCriteria implements CriteriaInterface
{
    private $search;

    function __construct($search)
    {
        $this->search = $search;
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

        $palavra = ($this->search['operador'] == 'like') ? '%' . $this->search['palavra'] . '%' : $this->search['palavra'];
        $operador = ($this->search['operador'] == 'like') ? $this->search['operador'] = 'like' : $this->search['operador'];


        if($this->search['por']) {
            $m = $model->where($this->search['por'],  $operador, $palavra);
            $m->join('users', 'clients.user_id', '=', 'users.id');
        }

        return $m;
    }
}
