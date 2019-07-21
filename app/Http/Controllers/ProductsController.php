<?php

namespace ApiDelivery\Http\Controllers;

use ApiDelivery\Criteria\OrderByCriteria;
use ApiDelivery\Criteria\SearchCriteria;
use ApiDelivery\Models\Category;
use ApiDelivery\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use ApiDelivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use ApiDelivery\Http\Requests\ProductCreateRequest;
use ApiDelivery\Http\Requests\ProductUpdateRequest;
use ApiDelivery\Repositories\ProductRepository;
use ApiDelivery\Validators\ProductValidator;
use Storage;

/**
 * Class ProductsController.
 *
 * @package namespace ApiDelivery\Http\Controllers;
 */
class ProductsController extends Controller
{
    /**
     * @var ProductRepository
     */
    protected $repository;

    /**
     * @var ProductValidator
     */
    protected $validator;

    /**
     * ProductsController constructor.
     *
     * @param ProductRepository $repository
     * @param ProductValidator $validator
     */
    public function __construct(ProductRepository $repository, ProductValidator $validator)
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

        $products = $this->repository->paginate(5);

        return view('products.index', compact(['products', 'search']));
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('products.create', compact('categories'));
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
    public function store(ProductCreateRequest $request)
    {
        try {



            if($request->hasFile('image') && $request->file('image')->isValid()){
                $upload = $request->file('image');
                $s3 = $upload->store('uploads');
                $product['filename'] = $s3;
                $product['filetype'] = $upload->getMimeType();
                $product['filesize'] = $upload->getClientSize();
            }

            $product['name'] = $request->get('name');
            $product['price'] = $request->get('price');
            $product['category_id'] = $request->get('category_id');
            $product['description'] = $request->get('description');


            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $product = $this->repository->create($product);
            flash('Registro adicionado com sucesso')->success()->important();
            return redirect()->route('products');
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
        $product = $this->repository->find($id);
        return view('products.show', compact('product'));
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
        $product = $this->repository->find($id);
        $categories = Category::pluck('name', 'id');

        return view('products.edit', compact(['product', 'categories']));
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
    public function update(ProductUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            if($request->hasFile('image') && $request->file('image')->isValid()){
                $upload = $request->file('image');
//                $product['filename'] = uniqid(date('HisYmd')) . '.'. $upload->getClientOriginalExtension();
//                $product['filetype'] = $upload->getMimeType();
//                $product['filesize'] = $upload->getClientSize();
                $s3 = $upload->store('uploads');
                $product['filename'] = $s3;
                $product['filetype'] = $upload->getMimeType();
                $product['filesize'] = $upload->getClientSize();

                //$upload->storeAs('uploads', $product['filename']);
                //Storage::disk('s3')->put('images/originals', fopen($upload, 'r+'), 'images');

            }

            $product['name'] = $request->get('name');
            $product['price'] = $request->get('price');
            $product['category_id'] = $request->get('category_id');
            $product['description'] = $request->get('description');

            flash('Registro atualizado com sucesso')->success()->important();
            $product = $this->repository->update($product, $id);
            return redirect()->route('products');
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
        return redirect()->route('products');
    }

    public function search(Request $request)
    {
        $this->repository->pushCriteria(new SearchCriteria($request->all()));
        $search = $request->all();
        $products = $this->repository->paginate(5)->setPath('./')->appends(['palavra' => $request->get('palavra'), 'por' => $request->get('por'), 'operador' => $request->get('operador')]);
        return view('products.index', compact(['products', 'search']));
    }
}
