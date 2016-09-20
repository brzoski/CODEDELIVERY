<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\AdminCupomRequest;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

use CodeDelivery\Repositories\CupomRepository;

class CupomsController extends Controller
{

	public function __construct(CupomRepository $repository){
		$this->repository = $repository;
	}

    public function index(){
    	//$categories = $repository->all();
    	$cupoms = $this->repository->paginate(5);
    	return view('admin.cupoms.index', compact('cupoms') );
    }


        public function create(){
        //$categories = $repository->paginate(5);
        return view('admin.cupoms.create', compact('cupoms') );
    }

         public function store(AdminCupomRequest $request){
        $data = $request->all();
        $this->repository->create($data);
        //return view('admin.categories.create', compact('categories') );

        return redirect()->route('admin.cupoms.index');
    }

}
