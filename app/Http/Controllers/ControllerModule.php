<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Modules;
use DB;

class ControllerModule extends Controller {

	public function index()
	{
		//
		$modules = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM modules ORDER BY module asc"));
		return view('module.index', compact('modules'));

	}

	public function create()
	{
		//
		return view('module.create');	
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['module'=>'required','count_box'=>'required']);

		$model_input = $request->all(); 
		
		$module = $model_input['module'];
		$count_box_input = $model_input['count_box'];
				
		// if (isset($model_input['mandatory_to_check'])) {
		if ($count_box_input == "YES") {
			$count_box = 'YES';
		} else {
			$count_box = 'NO';
		}
		// dd($count_box_input);

		try {
			$table = new Modules;

			$table->module = $module;
			$table->count_box = $count_box;
		
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('module.error');			
		}

		return Redirect::to('/module');
	}

	public function edit($id) {

		$module = Modules::findOrFail($id);	
		return view('module.edit', compact('module'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['module'=>'required','count_box' => 'required']);
		//$model->update($request->all());

		$input = $request->all(); 
		// dd($input);

		$module = $input['module'];
		$count_box_input = $input['count_box'];
		
		if ($count_box_input == 'YES') {
			$count_box = 'YES';
		} else {
			$count_box = 'NO';
		}

		$table = Modules::findOrFail($id);		

		try {

			$table->module = $module;
			$table->count_box = $count_box;
												
			$table->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('module.error');			
		}
		
		return Redirect::to('/module');
	}

	

}
