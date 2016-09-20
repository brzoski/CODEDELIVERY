<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
//use CodeDelivery\Http\Requests\AdminCheckoutRequest;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

//use CodeDelivery\Repositories\CheckoutRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\ProductRepository;
use CodeDelivery\Repositories\UserRepository;

use CodeDelivery\Services\OrderService;

use Auth;

class CheckoutController extends Controller
{

    private $repository;
    private $productRepository;
    private $userRepository;

	public function __construct(
        OrderRepository $repository,
        OrderService $service, 
        ProductRepository $productRepository, 
        UserRepository $userRepository )
    {
		$this->repository = $repository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->service = $service;
	}

    public function index(){
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $orders = $this->repository->scopeQuery(function($query) use($clientId){
            return $query->where('client_id', '=', $clientId);
        })->paginate();

        return view('customer.order.index', compact('orders'));

    }

    public function create(){
        //$categories = $repository->paginate(5);

        //$products = $this->productRepository->lists('id', 'name');
        $products = $this->productRepository->all();

        return view('customer.order.create', compact('products') );
    }

    public function store(Request $request){

        $data = $request->all();
        $clientId = $this->userRepository->find(Auth::user()->id)->client->id;
        $data['client_id'] = $clientId;
        // Utiliza o Service Order Criado
        $this->service->create($data);

        return redirect(route('customer.order.index'));
    }



}
