<?php

namespace ApiDelivery\Http\Controllers;

use ApiDelivery\Criteria\OrderByCriteria;
use ApiDelivery\Criteria\SearchCriteria;
use ApiDelivery\Criteria\SearchWithJoinCriteria;
use ApiDelivery\Models\User;
use Illuminate\Http\Request;

use ApiDelivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiDelivery\Http\Requests\ClientCreateRequest;
use ApiDelivery\Http\Requests\ClientUpdateRequest;
use ApiDelivery\Repositories\ClientRepository;
use ApiDelivery\Validators\ClientValidator;

/**
 * Class ClientsController.
 *
 * @package namespace ApiDelivery\Http\Controllers;
 */
class ClientsController extends Controller
{
    /**
     * @var ClientRepository
     */
    protected $repository;

    /**
     * @var ClientValidator
     */
    protected $validator;

    /**
     * ClientsController constructor.
     *
     * @param ClientRepository $repository
     * @param ClientValidator $validator
     */
    public function __construct(ClientRepository $repository, ClientValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
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
        if ($request->get('palavra')) {
            $search = $request->all();
            $this->repository->pushCriteria(new SearchCriteria($request->all()));
        }

        $clients = $this->repository->paginate(5);

        return view('clients.index', compact(['clients', 'search']));
    }

    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('clients.create', compact('users'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  ClientCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ClientCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $client = $this->repository->create($request->all());
            flash('Registro adicionado com sucesso')->success()->important();
            return redirect()->route('clients');
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = $this->repository->find($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::pluck('name', 'id');
        $client = $this->repository->find($id);

        return view('clients.edit', compact(['client', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ClientUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ClientUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $client = $this->repository->update($request->all(), $id);

            flash('Registro alterado com sucesso')->success()->important();
            return redirect()->route('clients');
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        flash('Registro removido com sucesso')->success()->important();
        return redirect()->route('clients');
    }

    public function search(Request $request)
    {
        $this->repository->pushCriteria(new SearchWithJoinCriteria($request->all()));
        $search = $request->all();
        $clients = $this->repository->paginate(5)->setPath('./')->appends(['palavra' => $request->get('palavra'), 'por' => $request->get('por'), 'operador' => $request->get('operador')]);
        return view('clients.index', compact(['clients', 'search']));
    }
}
