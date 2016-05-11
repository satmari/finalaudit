<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Position;
use App\CategoryPosition;
use DB;

class ControllerPosition extends Controller {

	public function index()
	{
		//
		$position = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM positions ORDER BY position_id asc"));
		return view('position.index', compact('position'));
	}

	public function create()
	{
		//
		return view('position.create');	
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['position_id'=>'required','position_name'=>'required','position_applay_to_all'=>'required']);

		$input = $request->all(); 
		
		$position_id = $input['position_id'];
		$position_name = $input['position_name'];
		$position_name_1 = $input['position_name_1'];
		$position_name_2 = $input['position_name_2'];
		$position_description = $input['position_description'];
		$position_description_1 = $input['position_description_1'];
		$position_description_2 = $input['position_description_2'];
		
		$position_applay_to_all = $input['position_applay_to_all'];

		$link_type = "AUTOMATIC";

		try {
			$position = new Position;

			$position->position_id = $position_id;
			$position->position_name = $position_name;
			$position->position_name_1 = $position_name_1;
			$position->position_name_2 = $position_name_2;
			$position->position_description = $position_description;
			$position->position_description_1 = $position_description_1;
			$position->position_description_2 = $position_description_2;

			$position->position_applay_to_all = $position_applay_to_all;
			
			$position->save();

		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('position.error');			
		}

		if ($position_applay_to_all == "YES") {
			
			$categories = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT category_id,category_name FROM categories"));
			//dd($categories);

			foreach ($categories as $category) {
				//dd($category->category_name);

				$exist = DB::table('defect_types')
			                    ->where('category_id', '=', $category->category_id)
			                    ->where('position_id', '=', $position_id)
			                    ->count();
				if ($exist == 0) {
					try {
						$categoryposition = new CategoryPosition;

						$categoryposition->position_id = $position_id;
						$categoryposition->position_name = $position_name;
						$categoryposition->category_id = $category->category_id;
						$categoryposition->category_name = $category->category_name;
						$categoryposition->link_type = $link_type;
						
						$categoryposition->save();
					}
					catch (\Illuminate\Database\QueryException $e) {
						return view('position.error');			
					}
				}
			}
		}

		//return view('position.index');
		return Redirect::to('/position');
	}

	public function edit($id) {

		$position = Position::findOrFail($id);

		// dropdown menu
		//$defect_levels = DefectLevel::orderBy('defect_level_id')->lists('defect_level_name','defect_level_id');
		//$defect_level_name = $position->defect_level_name;
		//$defect_level_selected = DB::connection('sqlsrv')->select(DB::raw("SELECT defect_level_id FROM defect_levels WHERE defect_level_name = '".$defect_level_name."'"));
		//$defect_level_selected_id = $defect_level_selected[0]->defect_level_id;
		// dd($defect_level_selected_id);
		//$defect_level_selected_id = $position->defect_level_id;

		return view('position.edit', compact('position'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['position_id'=>'required','position_name'=>'required','position_applay_to_all' => 'required']);

		$position = Position::findOrFail($id);		
		//$position->update($request->all());

		$input = $request->all(); 
		//dd($input);

		$position_id = $input['position_id'];
		$position_name = $input['position_name'];
		$position_applay_to_all = $input['position_applay_to_all'];

		$link_type = "AUTOMATIC";

		try {
			//$position->id = $input['id'];
			$position->position_id = $input['position_id'];
			$position->position_name = $input['position_name'];
			$position->position_name_1 = $input['position_name_1'];
			$position->position_name_2 = $input['position_name_2'];

			$position->position_description = $input['position_description'];
			$position->position_description_1 = $input['position_description_1'];
			$position->position_description_2 = $input['position_description_2'];
			
			$position->position_applay_to_all = $input['position_applay_to_all'];
						
			$position->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('position.error');			
		}

		if ($position_applay_to_all == "YES") {
			
			$categories = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT category_id,category_name FROM categories"));
			//dd($categories);

			foreach ($categories as $category) {
				//dd($category->category_name);

				try {
					$categoryposition = new CategoryPosition;

					$categoryposition->position_id = $position_id;
					$categoryposition->position_name = $position_name;
					$categoryposition->category_id = $category->category_id;
					$categoryposition->category_name = $category->category_name;
					$categoryposition->link_type = $link_type;
					
					$categoryposition->save();
				}
				catch (\Illuminate\Database\QueryException $e) {
					return view('position.error');			
				}
			}
		} elseif ($position_applay_to_all == "NO") {

			//DB::table('category_positions')->where('position_id', '=', $position_id)->delete();
		}
		
		return Redirect::to('/position');
	}

	public function delete($id) {

		$position = Position::findOrFail($id);
		$position_id = $position->position_id;
		
		$position->delete();
		DB::table('category_positions')->where('position_id', '=', $position_id)->delete();
		
		return Redirect::to('/position');
	}
}
