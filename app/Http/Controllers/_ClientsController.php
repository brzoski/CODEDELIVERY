<?php

namespace CodeDelivery\Http\Controllers;

use Illuminate\Http\Request;
use CodeDelivery\Http\Requests\AdminCategoryRequest;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

use CodeDelivery\Repositories\CategoryRepository;

class CategoriesController extends Controller
{

	public function __construct(CategoryRepository $repository){
		$this->repository = $repository;
	}

    public function index(){
    	//$categories = $repository->all();
    	$categories = $this->repository->paginate(5);
    	return view('admin.categories.index', compact('categories') );
    }

    public function create(){
    	//$categories = $repository->paginate(5);
    	return view('admin.categories.create', compact('categories') );
    }

    public function edit($id){
    	$category = $this->repository->find($id);
    	return view('admin.categories.edit', compact('category'));
    }

    public function update(AdminCategoryRequest $request, $id){
    	$data = $request->all();
    	$this->repository->update($data, $id);
 
    	return redirect()->route('admin.categories.index');
    }

     public function store(AdminCategoryRequest $request){
    	$data = $request->all();
    	$this->repository->create($data);
    	//return view('admin.categories.create', compact('categories') );

    	return redirect()->route('admin.categories.index');
    }

}
