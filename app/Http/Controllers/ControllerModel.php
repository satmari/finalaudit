<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models;
use App\Category;
use DB;

class ControllerModel extends Controller {

	public function index()
	{
		//
		$model = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM models ORDER BY model_name asc"));
		return view('model.index', compact('model'));
	}

	public function create()
	{
		//
		$categories = Category::orderBy('category_id')->lists('category_name','category_id'); //pluck
		return view('model.create',compact('categories'));	
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['model_name'=>'required','model_brand'=>'required','category_id' => 'required']);

		$model_input = $request->all(); 
		
		$model_name = $model_input['model_name'];
		$model_brand = $model_input['model_brand'];
		$category_id = $model_input['category_id'];
		
		// if (isset($model_input['mandatory_to_check'])) {
		if ($model_input['mandatory_to_check'] == "YES") {
			$mandatory_to_check = 'YES';
		} else {
			$mandatory_to_check = 'NO';
		}
		// dd($mandatory_to_check);

		$categories = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM categories WHERE category_id = '".$category_id."'"));
		//dd($categories[0]->category_name);

		$category_name = $categories[0]->category_name;
		$category_name_1 = $categories[0]->category_name_1;
		$category_name_2 = $categories[0]->category_name_2;
		$category_description = $categories[0]->category_description;
		$category_description_1 = $categories[0]->category_description_1;
		$category_description_2 = $categories[0]->category_description_2;
		
		try {
			$model = new Models;

			$model->model_name = $model_name;
			$model->model_brand = $model_brand;
			$model->category_id = $category_id;
			$model->category_name = $category_name;
			$model->category_name_1 = $category_name_1;
			$model->category_name_2 = $category_name_2;
			$model->category_description = $category_description;
			$model->category_description_1 = $category_description_1;
			$model->category_description_2 = $category_description_2;
			$model->mandatory_to_check = $mandatory_to_check;

			$model->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('model.error');			
		}

		return Redirect::to('/model');
	}

	public function edit($id) {

		$model = Models::findOrFail($id);	
		$categories = Category::orderBy('category_id')->lists('category_name','category_id'); //pluck

		//$defect_level_name = $defect_type->defect_level_name;
		//$defect_level_selected = DB::connection('sqlsrv')->select(DB::raw("SELECT defect_level_id FROM defect_levels WHERE defect_level_name = '".$defect_level_name."'"));
		//$defect_level_selected_id = $defect_level_selected[0]->defect_level_id;
		// dd($defect_level_selected_id);

		$category_selected_id = $model->category_id;
		$mandatory_selected = 'YES';
		
		return view('model.edit', compact('model','categories','category_selected_id', 'mandatory_selected'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['model_name'=>'required','model_brand' => 'required', 'category_id' => 'required']);

		$model = Models::findOrFail($id);		
		//$model->update($request->all());

		$input = $request->all(); 
		//dd($input);

		$model_name = $input['model_name'];
		$model_brand = $input['model_brand'];
		$category_id = $input['category_id'];

		if ($input['mandatory_to_check'] == 'YES') {
			$mandatory_to_check = 'YES';
		} else {
			$mandatory_to_check = 'NO';
		}

		$categories = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM categories WHERE category_id = '".$category_id."'"));
		//dd($categories[0]->category_name);

		$category_name = $categories[0]->category_name;
		$category_name_1 = $categories[0]->category_name_1;
		$category_name_2 = $categories[0]->category_name_2;
		$category_description = $categories[0]->category_description;
		$category_description_1 = $categories[0]->category_description_1;
		$category_description_2 = $categories[0]->category_description_2;

		try {

			$model->model_name = $model_name;
			$model->model_brand = $model_brand;
			$model->category_id = $category_id;
			$model->category_name = $category_name;
			$model->category_name_1 = $category_name_1;
			$model->category_name_2 = $category_name_2;
			$model->category_description = $category_description;
			$model->category_description_1 = $category_description_1;
			$model->category_description_2 = $category_description_2;
			$model->mandatory_to_check = $mandatory_to_check;
									
			$model->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('model.error');			
		}
		
		return Redirect::to('/model');
	}

	public function delete($id) {

		$model = Models::findOrFail($id);
		$model_id = $model->model_id;

		$model->delete();
		
		return Redirect::to('/model');
	}
	

}
