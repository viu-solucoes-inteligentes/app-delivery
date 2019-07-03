<?php

namespace ApiDelivery\Repositories;

use ApiDelivery\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiDelivery\Repositories\UserRepository;
use ApiDelivery\Models\User;
use ApiDelivery\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace ApiDelivery\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        'name' => 'like',
        'email' => 'like',
        'role' => '='
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
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

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
