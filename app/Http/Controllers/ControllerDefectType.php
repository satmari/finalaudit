<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\DefectType;
use App\DefectLevel;
use App\CategoryDefectType;
use DB;

class ControllerDefectType extends Controller {

	public function index()
	{
		//
		$defect_types = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_types ORDER BY defect_type_id asc"));
		return view('defecttype.index', compact('defect_types'));
	}

	public function create()
	{
		//
		//$defect_levels = DefectLevel::all(['id', 'defect_level_name']);
		$defect_levels = DefectLevel::orderBy('defect_level_id')->lists('defect_level_name','defect_level_id'); //pluck
		//dd($defect_levels);
		return view('defecttype.create', compact('defect_levels'));	
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['defect_type_id'=>'required','defect_type_name'=>'required','defect_level_id'=>'required','defect_applay_to_all'=>'required']);

		$defect_type_input = $request->all(); 
		
		$defect_type_id = $defect_type_input['defect_type_id'];
		$defect_type_name = $defect_type_input['defect_type_name'];
		$defect_type_name_1 = $defect_type_input['defect_type_name_1'];
		$defect_type_name_2 = $defect_type_input['defect_type_name_2'];
		$defect_type_description = $defect_type_input['defect_type_description'];
		$defect_type_description_1 = $defect_type_input['defect_type_description_1'];
		$defect_type_description_2 = $defect_type_input['defect_type_description_2'];

		$defect_level_id = $defect_type_input['defect_level_id'];
		$defect_level = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_levels WHERE defect_level_id = '".$defect_level_id."'"));
		
		$defect_level_name = $defect_level[0]->defect_level_name;
		$defect_level_rejected = $defect_level[0]->defect_level_rejected;
		
		$defect_applay_to_all = $defect_type_input['defect_applay_to_all'];

		$link_type = "AUTOMATIC";

		try {
			$defect_type = new DefectType;

			$defect_type->defect_type_id = $defect_type_id;
			$defect_type->defect_type_name = $defect_type_name;
			$defect_type->defect_type_name_1 = $defect_type_name_1;
			$defect_type->defect_type_name_2 = $defect_type_name_2;
			$defect_type->defect_type_description = $defect_type_description;
			$defect_type->defect_type_description_1 = $defect_type_description_1;
			$defect_type->defect_type_description_2 = $defect_type_description_2;

			$defect_type->defect_level_id = $defect_level_id;
			$defect_type->defect_level_name = $defect_level_name;
			$defect_type->defect_level_rejected = $defect_level_rejected;

			$defect_type->defect_applay_to_all = $defect_applay_to_all;
			
			$defect_type->save();

		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('defecttype.error');			
		}

		if ($defect_applay_to_all == "YES") {
			
			$categories = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT category_id,category_name FROM categories"));
			//dd($categories);

			foreach ($categories as $category) {
				//dd($category->category_name);

				try {
					$categorydefecttype = new CategoryDefectType;

					$categorydefecttype->defect_type_id = $defect_type_id;
					$categorydefecttype->defect_type_name = $defect_type_name;
					$categorydefecttype->category_id = $category->category_id;
					$categorydefecttype->category_name = $category->category_name;
					$categorydefecttype->link_type = $link_type;
					
					$categorydefecttype->save();
				}
				catch (\Illuminate\Database\QueryException $e) {
					return view('defecttype.error');			
				}
			}
		}

		//return view('defecttype.index');
		return Redirect::to('/defecttype');
	}

	public function edit($id) {

		$defect_type = DefectType::findOrFail($id);	
		$defect_levels = DefectLevel::orderBy('defect_level_id')->lists('defect_level_name','defect_level_id'); //pluck

		//$defect_level_name = $defect_type->defect_level_name;
		//$defect_level_selected = DB::connection('sqlsrv')->select(DB::raw("SELECT defect_level_id FROM defect_levels WHERE defect_level_name = '".$defect_level_name."'"));
		//$defect_level_selected_id = $defect_level_selected[0]->defect_level_id;
		// dd($defect_level_selected_id);

		$defect_level_selected_id = $defect_type->defect_level_id;

		return view('defecttype.edit', compact('defect_type','defect_levels','defect_level_selected_id'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['defect_type_id'=>'required','defect_type_name'=>'required','defect_level_id' => 'required','defect_applay_to_all' => 'required']);

		$defect_type = DefectType::findOrFail($id);		
		//$defect_type->update($request->all());

		$input = $request->all(); 
		//dd($input);

		$defect_type_id = $input['defect_type_id'];
		$defect_type_name = $input['defect_type_name'];
		$defect_applay_to_all = $input['defect_applay_to_all'];

		$link_type = "AUTOMATIC";

		try {
			//$defect_type->id = $input['id'];
			$defect_type->defect_type_id = $input['defect_type_id'];
			$defect_type->defect_type_name = $input['defect_type_name'];
			$defect_type->defect_type_name_1 = $input['defect_type_name_1'];
			$defect_type->defect_type_name_2 = $input['defect_type_name_2'];

			$defect_type->defect_type_description = $input['defect_type_description'];
			$defect_type->defect_type_description_1 = $input['defect_type_description_1'];
			$defect_type->defect_type_description_2 = $input['defect_type_description_2'];
			
			$defect_level_id = $input['defect_level_id']; 
			$defect_level = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_levels WHERE defect_level_id = '".$defect_level_id."'"));

			$defect_type->defect_level_id = $defect_level_id;
			$defect_type->defect_level_name = $defect_level[0]->defect_level_name;
			$defect_type->defect_level_rejected = $defect_level[0]->defect_level_rejected;

			$defect_type->defect_applay_to_all = $input['defect_applay_to_all'];
						
			$defect_type->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('defecttype.error');			
		}

		if ($defect_applay_to_all == "YES") {
			
			$categories = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT category_id,category_name FROM categories"));
			//dd($categories);

			foreach ($categories as $category) {
				//dd($category->category_name);

				$exist = DB::table('defect_types')
			                    ->where('category_id', '=', $category->category_id)
			                    ->where('defect_type_id', '=', $defect_type_id)
			                    ->count();
				if ($exist == 0) {
					try {
						$categorydefecttype = new CategoryDefectType;

						$categorydefecttype->defect_type_id = $defect_type_id;
						$categorydefecttype->defect_type_name = $defect_type_name;
						$categorydefecttype->category_id = $category->category_id;
						$categorydefecttype->category_name = $category->category_name;
						$categorydefecttype->link_type = $link_type;
						
						$categorydefecttype->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						return view('defecttype.error');			
					}
				}
			}
		} elseif ($defect_applay_to_all == "NO") {

			// DB::table('category_defect_types')->where('defect_type_id', '=', $defect_type_id)->delete();
		}
		
		return Redirect::to('/defecttype');
	}

	public function delete($id) {

		$defect_type = DefectType::findOrFail($id);
		$defect_type_id = $defect_type->defect_type_id;
		
		$defect_type->delete();
		DB::table('category_defect_types')->where('defect_type_id', '=', $defect_type_id)->delete();
		
		
		return Redirect::to('/defecttype');
	}

}