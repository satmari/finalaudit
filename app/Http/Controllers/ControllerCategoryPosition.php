<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\CategoryPosition;
use App\Category;
use App\Position;
use DB;

class ControllerCategoryPosition extends Controller {

	public function index()
	{
		//
		$categoryposition = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM category_positions ORDER BY id asc"));
		return view('categoryposition.index', compact('categoryposition'));
	}

	public function create()
	{
		//
		//$positions = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT position_id,position_name FROM positions"));
		//$category = DB::connection('sqlsrv')->select(DB::raw("SELECT DISTINCT category_id,category_name FROM categories"));

		$positions = Position::orderBy('position_id')->where('position_applay_to_all','=','NO')->lists('position_name','position_id');
		$category = Category::orderBy('category_id')->lists('category_name','category_id'); //pluck

		//dd($positions);
		//dd($category);

		return view('categoryposition.create',compact('positions','category'));	
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['position_id'=>'required','category_id'=>'required']);

		$input = $request->all(); 
		
		$position_id = $input['position_id'];
		$position_name = DB::table('positions')->where('position_id', $position_id)->pluck('position_name');
		
		$category_id = $input['category_id'];
		$category_name = DB::table('categories')->where('category_id', $category_id)->pluck('category_name');

		$link_type = "MANUAL";
		
		try {
			$categoryposition = new CategoryPosition;

			$categoryposition->position_id = $position_id;
			$categoryposition->position_name = $position_name;
			$categoryposition->category_id = $category_id;
			$categoryposition->category_name = $category_name;
			$categoryposition->link_type = $link_type;
			
			$categoryposition->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('categoryposition.error');			
		}

		return Redirect::to('/categoryposition');
	}

	public function delete($id) {

		$position = CategoryPosition::findOrFail($id);
		$position->delete();

		return Redirect::to('/categoryposition');
	}

}