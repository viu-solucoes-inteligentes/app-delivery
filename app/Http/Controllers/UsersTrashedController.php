<?php

namespace ApiDelivery\Http\Controllers;

use ApiDelivery\Criteria\OnlyTrashedCriteria;
use ApiDelivery\Criteria\OrderByCriteria;
use ApiDelivery\Criteria\SearchCriteria;
use ApiDelivery\Repositories\UserRepository;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class UsersTrashedController extends Controller
{
    protected $repository;


    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new OnlyTrashedCriteria());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = [
            'palavra' => '',
            'por' => '',
            'operador' => ''
        ];

        $this->repository->pushCriteria(new OrderByCriteria(['type' => 'id', 'order' => 'DESC']));
        if($request->get('palavra')){
            $search = $request->all();
            $this->repository->pushCriteria(new SearchCriteria($request->all()));
        }



        $users = $this->repository->paginate(5);


        return view('users.trashed', compact(['users', 'search']));
    }

    public function search(Request $request)
    {
        $this->repository->pushCriteria(new SearchCriteria($request->all()));
        $search = $request->all();
        $users = $this->repository->paginate(5)->setPath('./')->appends(['palavra' => $request->get('palavra'), 'por' =>   $request->get('por'), 'operador' => $request->get('operador')]);
        return view('users.trashed', compact(['users', 'search']));
    }

    public function update($id)
    {
        try {
            $this->repository->restore($id);
            flash('Registro restaurado com sucesso')->success()->important();
            return redirect()->to('users');
        } catch (ValidatorException $e) {

            flash('Registro restaurado com sucesso')->error()->important();
            return redirect()->back();
        }
    }
}
