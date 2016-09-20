<?php
namespace CodeDelivery\Http\Controllers;
use Illuminate\Http\Request;
use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Requests\AdminOrderRequest;
use CodeDelivery\Http\Controllers\Controller;

use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Repositories\OrderRepository;
use CodeDelivery\Repositories\OrderItemRepository;

class OrdersController extends Controller
{
    private $repository, $orderItemRepository, $UserRepository;


    public function __construct(OrderRepository $repository, OrderItemRepository $orderItemRepository, UserRepository $UserRepository){
        $this->repository = $repository;
        $this->orderItemRepository = $orderItemRepository;
        $this->UserRepository = $UserRepository;
    }
    public  function index(){
        $orders = $this->repository->paginate(5);
        return view('admin.orders.index', compact('orders'));
    }

    public function edit( UserRepository $UserRepository, $id){
        $list_status = [0 => 'Pendente', 1 => 'A Caminho', 2 => 'Entregue'];
        $order = $this->repository->find($id);
        
        // Pega os Entregadores
        //$deliveryman = $UserRepository->getDeliverymen();
        $deliveryman = $UserRepository->findWhere(['role' => 'deliveryman'])->lists('name', 'id');


        return view('admin.orders.edit', compact('order', 'list_status', 'deliveryman'));
    }

    public function update(request $request, $id){
        $all = $request->all();
        $this->repository->update($all, $id);
        return redirect()->route('admin.orders.index');
    }




}
