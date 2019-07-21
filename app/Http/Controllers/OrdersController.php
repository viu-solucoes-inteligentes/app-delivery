<?php

namespace ApiDelivery\Http\Controllers;

use ApiDelivery\Criteria\OrderByCriteria;
use ApiDelivery\Criteria\SearchCriteria;
use ApiDelivery\Models\Client;
use ApiDelivery\Models\Product;
use ApiDelivery\Models\User;
use Illuminate\Http\Request;

use ApiDelivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiDelivery\Http\Requests\OrderCreateRequest;
use ApiDelivery\Http\Requests\OrderUpdateRequest;
use ApiDelivery\Repositories\OrderRepository;
use ApiDelivery\Validators\OrderValidator;

/**
 * Class OrdersController.
 *
 * @package namespace ApiDelivery\Http\Controllers;
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    protected $repository;

    /**
     * @var OrderValidator
     */
    protected $validator;

    /**
     * OrdersController constructor.
     *
     * @param OrderRepository $repository
     * @param OrderValidator $validator
     */
    public function __construct(OrderRepository $repository, OrderValidator $validator)
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

        $orders = $this->repository->paginate(5);

        return view('orders.index', compact(['orders', 'search']));
    }


    public function create()
    {
        $users = User::pluck('name', 'id');
        $products = Product::pluck('name', 'id');

        return view('orders.create', compact(['order', 'users', 'products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OrderCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(OrderCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $client = $this->repository->create($request->all());
            flash('Registro adicionado com sucesso')->success()->important();
            return redirect()->route('orders');
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
        $order = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $order,
            ]);
        }

        return view('orders.show', compact('order'));
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
        $products = Product::pluck('name', 'id');
        $order = $this->repository->find($id);

        return view('orders.edit', compact(['order', 'users', 'products']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  OrderUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(OrderUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $order = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Order updated.',
                'data'    => $order->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Order deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Order deleted.');
    }
}
