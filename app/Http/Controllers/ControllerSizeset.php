<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Sizeset;
use DB;
use Auth;
use App\User;

class ControllerSizeset extends Controller {

	public function __construct()
	{
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	public function index()
	{	
		//
		$name_id = Auth::user()->name_id;
		$user = User::find(Auth::id());

		try {

			if (($user->is('admin')) OR ($user->is('guest'))) { 
				$sizeset = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE (scanned = 'YES' AND shipped = 'NO') ORDER BY id asc"));
				return view('sizeset.index', compact('sizeset'));
			} 
			if (($user->is('planer'))) { 
				$sizeset = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE (scanned = 'YES' AND shipped = 'NO') ORDER BY id asc"));
				return view('sizeset.index', compact('sizeset'));
			}
			if (($user->is('operator'))) { 
				$sizeset = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE (scanned = 'YES' AND collected = 'NO') ORDER BY id asc"));
				return view('sizeset.index', compact('sizeset'));
			}
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/sizeset');
		}
	}

	public function sizeset_all()
	{	
		try {
			$sizeset = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset ORDER BY id asc"));
			return view('sizeset.index_all', compact('sizeset'));
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/sizeset_all');
		}
	}

	public function edit($id) {

		$sizeset = sizeset::findOrFail($id);		
		return view('sizeset.edit', compact('sizeset'));
	}

	// ne koristi se
	public function update($id, Request $request) {
		//
		$this->validate($request, ['sku'=>'required']);

		$sizeset = sizeset::findOrFail($id);		
		$input = $request->all(); 
		//dd($input);

		$sku = $input['sku'];
		$stlye = $input['style'];
		$color = $input['color'];
		$size = $input['size'];

		$scanned = $input['scanned'];
		$collected = $input['collected'];
		$shipped = $input['shipped'];


		// try {
			//$defect_level->id = $input['id'];
			// $defect_level->defect_level_id = $input['sku'];
			// $defect_level->defect_level_name = $input['defect_level_name'];
			// $defect_level->defect_level_rejected = $input['defect_level_rejected'];
			//$defect_level->pcs_rejected = $input['pcs_rejected'];
					
			// $defect_level->save();
		// }
		// catch (\Illuminate\Database\QueryException $e) {
		// 	return view('defectlevel.error');			
		// }
		
		return Redirect::to('/sizeset');
	}

	public function scanned($id) 
	{
		try {
			$sizeset = Sizeset::findOrFail($id);
			$sizeset->scanned = 'YES';
			$sizeset->scanned_date = date("Y-m-d H:i:s");
			$sizeset->scanned_user = Auth::user()->username;
			$sizeset->save();
			return Redirect::to('/sizeset');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/sizeset/scanned/'.$sizeset->id);
		}
	}

	public function collected($id) 
	{
		try {
			$sizeset = Sizeset::findOrFail($id);
			$sizeset->collected = 'YES';
			$sizeset->collected_date = date("Y-m-d H:i:s");
			$sizeset->collected_user = Auth::user()->username;
			$sizeset->save();
			return Redirect::to('/sizeset');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/sizeset/collected/'.$sizeset->id);
		}
	}

	public function shipped($id, Request $request) 
	{
		$this->validate($request, ['date'=>'required']);
		$input = $request->all();
		$date = $input['date'];

		if ($input['comment']) {
			$comment = $input['comment'];	
		} else {
			$comment = '';
		}
		
		try {
			$sizeset = Sizeset::findOrFail($id);

			if (isset($input['color'])) {
				$sizeset->color = $input['color'];
			}
			$sizeset->collected = 'YES';
			$sizeset->scanned = 'YES';
			$sizeset->shipped = 'YES';
			//$sizeset->shipped_date = date("Y-m-d H:i:s");
			$sizeset->shipped_date = $date;
			$sizeset->shipped_user = Auth::user()->username;
			$sizeset->temp_coloumn = $comment;
			$sizeset->save();
			return Redirect::to('/sizeset');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/sizeset/shipped/'.$sizeset->id);
		}
	}

}
