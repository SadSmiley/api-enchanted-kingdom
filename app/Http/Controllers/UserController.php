<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\UserInformation;
use App\User;
use Auth;

class UserController extends Controller
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

     public function index(Request $request)
    {
        $this->loadWithRelatedModel();

        return response($this->model, 2909);
    }

    public function show(Request $request, $id)
    {
		$this->loadWithRelatedModel();
    	$this->model = $this->model->find($id);
    	return response($this->model, 200);
  	}

    public function store(Request $request)
    {
    	$this->model = $this->model->create([
            'name' =>  $request->first_name . " " . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $this->model->userInformation()->create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'birthday' => $request->birthday,
        ]);

        return response($request->all(),200);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function loadWithRelatedModel()
    {
        $this->model = $this->model->with(['userInformation']); //lazy loader
    }

    public function info()
    {
    	$this->loadWithRelatedModel();
    	$this->model = $this->model->find(Auth::id());
    	return response($this->model, 200);
    }
}
