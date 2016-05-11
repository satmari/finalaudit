<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Category;
use App\CategoryDefectType;
use App\CategoryPosition;
use DB;

class ControllerCategory extends Controller {

	public function index()
	{
		//
		$category = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM categories ORDER BY category_id asc"));
		return view('category.index', compact('category'));
	}

	public function create()
	{
		//
		return view('category.create');	
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['category_id'=>'required','category_name'=>'required']);

		$category_input = $request->all(); 
		
		$category_id = $category_input['category_id'];
		$category_name = $category_input['category_name'];
		$category_name_1 = $category_input['category_name_1'];
		$category_name_2 = $category_input['category_name_2'];
		$category_description = $category_input['category_description'];
		$category_description_1 = $category_input['category_description_1'];
		$category_description_2 = $category_input['category_description_2'];

		$link_type = "AUTOMATIC";

		try {
			$category = new Category;

			$category->category_id = $category_id;
			$category->category_name = $category_name;
			$category->category_name_1 = $category_name_1;
			$category->category_name_2 = $category_name_2;
			$category->category_description = $category_description;
			$category->category_description_1 = $category_description_1;
			$category->category_description_2 = $category_description_2;

			$category->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('category.error');			
		}

		$defecttypes = DB::connection('sqlsrv')->select(DB::raw("SELECT defect_type_id,defect_type_name FROM defect_types WHERE defect_applay_to_all = 'YES'"));
		//dd($defecttypes);

		foreach ($defecttypes as $defect) {
			
			try {
				$categorydefecttype = new CategoryDefectType;

				$categorydefecttype->defect_type_id = $defect->defect_type_id;
				$categorydefecttype->defect_type_name = $defect->defect_type_name;
				$categorydefecttype->category_id = $category_id;
				$categorydefecttype->category_name = $category_name;
				$categorydefecttype->link_type = $link_type;
				
				$categorydefecttype->save();
			}
			catch (\Illuminate\Database\QueryException $e) {
				return view('category.error');			
			}
		}

		$positions = DB::connection('sqlsrv')->select(DB::raw("SELECT position_id,position_name FROM positions WHERE position_applay_to_all = 'YES'"));
		//dd($positions);

		foreach ($positions as $position) {
			
			try {
				$categoryposition = new CategoryPosition;

				$categoryposition->position_id = $position->position_id;
				$categoryposition->position_name = $position->position_name;
				$categoryposition->category_id = $category_id;
				$categoryposition->category_name = $category_name;
				$categoryposition->link_type = $link_type;
				
				$categoryposition->save();
			}
			catch (\Illuminate\Database\QueryException $e) {
				return view('category.error');			
			}
		}
		
		return Redirect::to('/category');
	}

	public function edit($id) {

		$category = Category::findOrFail($id);	
		
		return view('category.edit', compact('category'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['category_id'=>'required','category_name'=>'required']);

		$category = Category::findOrFail($id);		
		//$category->update($request->all());

		$input = $request->all(); 
		//dd($input);

		try {
			//$category->id = $input['id'];
			$category->category_id = $input['category_id'];
			$category->category_name = $input['category_name'];
			$category->category_name_1 = $input['category_name_1'];
			$category->category_name_2 = $input['category_name_2'];

			$category->category_description = $input['category_description'];
			$category->category_description_1 = $input['category_description_1'];
			$category->category_description_2 = $input['category_description_2'];
									
			$category->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('category.error');			
		}
		
		return Redirect::to('/category');
	}

	public function delete($id) {

		$category = Category::findOrFail($id);
		$category_id = $category->category_id;

		$category->delete();
		DB::table('category_defect_types')->where('category_id', '=', $category_id)->delete();
		DB::table('category_positions')->where('category_id', '=', $category_id)->delete();
		

		return Redirect::to('/category');
	}
	

}
