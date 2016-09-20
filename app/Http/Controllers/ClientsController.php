<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\AdminClientRequest;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

use CodeDelivery\Services\ClientService;

class ClientsController extends Controller
{

	public function __construct(ClientRepository $clientRepository, UserRepository $userRepository, ClientService $clientService){
		$this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
        $this->clientService = $clientService;
	}

    public function index(){
    	//$categories = $clientRepository->all();
    	$clients = $this->clientRepository->paginate(5);
    	return view('admin.clients.index', compact('clients') );
    }

    public function create(){
        //$clients = $this->clientRepository->lists("name", "id");
    	return view('admin.clients.create', compact('clients') );
    }

    public function edit($id){
    	$client = $this->clientRepository->find($id);
        // Usado para preencher o select
        //$users = $this->userRepository->lists("name", "id");
        
        return view('admin.clients.edit', compact('client', 'users' ));
    }

    public function update(AdminClientRequest $request, $id){
    	$data = $request->all();
    	//$this->clientRepository->update($data, $id);
        $this->clientService->update($data, $id);
    	return redirect()->route('admin.clients.index');
    }

     public function store(AdminClientRequest $request){
    	$data = $request->all();
    	$this->clientService->create($data);
    	//return view('admin.categories.create', compact('categories') );

    	return redirect()->route('admin.clients.index');
    }

    public function destroy($id){
        $this->repository->delete($id);
        return redirect()->route('admin.clients.index');
    }

}
