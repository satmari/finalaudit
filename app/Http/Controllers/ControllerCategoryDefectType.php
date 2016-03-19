<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\CategoryDefectType;
use App\Category;
use App\DefectType;
use DB;

class ControllerCategoryDefectType extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$categorydefecttypes = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM category_defect_types ORDER BY id asc"));
		return view('categorydefecttype.index', compact('categorydefecttypes'));
	}

	public function create()
	{
		//
		//$defect_types = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT defect_type_id,defect_type_name FROM defect_types"));
		//$category = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT category_id,category_name FROM categories"));

		$defect_types = DefectType::orderBy('defect_type_id')->where('defect_applay_to_all','=','NO')->lists('defect_type_name','defect_type_id');
		$category = Category::orderBy('category_id')->lists('category_name','category_id'); //pluck

		//dd($defect_types);
		//dd($category);

		return view('categorydefecttype.create',compact('defect_types','category'));	
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['defect_type_id'=>'required','category_id'=>'required']);

		$input = $request->all(); 
		
		$defect_type_id = $input['defect_type_id'];
		$defect_type_name = DB::table('defect_types')->where('defect_type_id', $defect_type_id)->pluck('defect_type_name');
		
		$category_id = $input['category_id'];
		$category_name = DB::table('categories')->where('category_id', $category_id)->pluck('category_name');

		$link_type = "MANUAL";
		
		try {
			$categorydefecttype = new CategoryDefectType;

			$categorydefecttype->defect_type_id = $defect_type_id;
			$categorydefecttype->defect_type_name = $defect_type_name;
			$categorydefecttype->category_id = $category_id;
			$categorydefecttype->category_name = $category_name;
			$categorydefecttype->link_type = $link_type;
			
			$categorydefecttype->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('categorydefecttype.error');			
		}

		return Redirect::to('/categorydefecttype');
	}

	public function delete($id) {

		$defect_type = CategoryDefectType::findOrFail($id);
		$defect_type->delete();

		return Redirect::to('/categorydefecttype');
	}

}