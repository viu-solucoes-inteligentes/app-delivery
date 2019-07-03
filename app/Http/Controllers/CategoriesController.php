<?php

namespace ApiDelivery\Http\Controllers;

use ApiDelivery\Criteria\OrderByCriteria;
use ApiDelivery\Criteria\SearchCriteria;
use Illuminate\Http\Request;

use ApiDelivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiDelivery\Http\Requests\CategoryCreateRequest;
use ApiDelivery\Http\Requests\CategoryUpdateRequest;
use ApiDelivery\Repositories\CategoryRepository;
use ApiDelivery\Validators\CategoryValidator;

/**
 * Class CategoriesController.
 *
 * @package namespace ApiDelivery\Http\Controllers;
 */
class CategoriesController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * @var CategoryValidator
     */
    protected $validator;

    /**
     * CategoriesController constructor.
     *
     * @param CategoryRepository $repository
     * @param CategoryValidator $validator
     */
    public function __construct(CategoryRepository $repository, CategoryValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
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

        $categories = $this->repository->paginate(5);

        return view('categories.index', compact(['categories', 'search']));
    }

    public function create()
    {
        return view('categories.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CategoryCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $category = $this->repository->create($request->all());
            flash('Registro adicionado com sucesso')->success()->important();
            return redirect()->route('categories');
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
        $category = $this->repository->find($id);
        return view('categories.show', compact('category'));
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
        $category = $this->repository->find($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $category = $this->repository->update($request->all(), $id);

            flash('Registro alterado com sucesso')->success()->important();
            return redirect()->route('categories');
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
        return redirect()->route('categories');
    }

    public function search(Request $request)
    {
        $this->repository->pushCriteria(new SearchCriteria($request->all()));
        $search = $request->all();
        $categories = $this->repository->paginate(5)->setPath('./')->appends(['palavra' => $request->get('palavra'), 'por' => $request->get('por'), 'operador' => $request->get('operador')]);
        return view('categories.index', compact(['categories', 'search']));
    }
}
