<?php

namespace ApiDelivery\Http\Controllers;

use ApiDelivery\Criteria\OnlyTrashedCriteria;
use ApiDelivery\Criteria\OrderByCriteria;
use ApiDelivery\Criteria\SearchCriteria;
use ApiDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoriesTrashedController extends Controller
{
    protected $repository;


    /**
     * UsersController constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(CategoryRepository $repository)
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

        $categories = $this->repository->paginate(5);

        return view('categories.trashed', compact(['categories', 'search']));
    }

    public function search(Request $request)
    {
        $this->repository->pushCriteria(new SearchCriteria($request->all()));
        $search = $request->all();
        $categories = $this->repository->paginate(5)->setPath('./')->appends(['palavra' => $request->get('palavra'), 'por' =>   $request->get('por'), 'operador' => $request->get('operador')]);
        return view('categories.trashed', compact(['categories', 'search']));
    }

    public function update($id)
    {
        try {
            $this->repository->restore($id);
            flash('Registro restaurado com sucesso')->success()->important();
            return redirect()->to('categories');
        } catch (ValidatorException $e) {

            flash('error', 'Falha ao tentar restaurar o registro, tente novamente.');
            return redirect()->back();
        }
    }
}
