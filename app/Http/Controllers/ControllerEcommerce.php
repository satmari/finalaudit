<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Ecommerce;
use DB;
use Auth;
use App\User;

class ControllerEcommerce extends Controller {

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
				$ecommerce = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM ecommerce WHERE (scanned = 'YES' AND shipped = 'NO') ORDER BY id asc"));
				return view('ecommerce.index', compact('ecommerce'));
			} 
			if (($user->is('planer'))) { 
				$ecommerce = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM ecommerce WHERE (scanned = 'YES' AND shipped = 'NO') ORDER BY id asc"));
				return view('ecommerce.index', compact('ecommerce'));
			}
			if (($user->is('operator'))) { 
				$ecommerce = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM ecommerce WHERE (scanned = 'YES' AND collected = 'NO') ORDER BY id asc"));
				return view('ecommerce.index', compact('ecommerce'));
			}
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/ecommerce');
		}
	}

	public function ecommerce_all()
	{	
		try {
			$ecommerce = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM ecommerce ORDER BY id asc"));
			return view('ecommerce.index_all', compact('ecommerce'));
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/ecommerce_all');
		}
	}

	public function edit($id) {

		$ecommerce = Ecommerce::findOrFail($id);		
		return view('ecommerce.edit', compact('ecommerce'));
	}

	// ne koristi se
	public function update($id, Request $request) {
		//
		$this->validate($request, ['sku'=>'required']);

		$ecommerce = Ecommerce::findOrFail($id);		
		$input = $request->all(); 
		//dd($input);

		$sku = $input['sku'];
		$stlye = $input['style'];
		$color = $input['color'];
		$size = $input['size'];

		$scanned = $input['scanned'];
		$collected = $input['collected'];
		$shipped = $input['shipped'];


		try {
			//$defect_level->id = $input['id'];
			// $defect_level->defect_level_id = $input['sku'];
			// $defect_level->defect_level_name = $input['defect_level_name'];
			// $defect_level->defect_level_rejected = $input['defect_level_rejected'];
			//$defect_level->pcs_rejected = $input['pcs_rejected'];
					
			// $defect_level->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('defectlevel.error');			
		}
		
		return Redirect::to('/ecommerce');
	}

	public function scanned($id) 
	{
		try {
			$ecommerce = Ecommerce::findOrFail($id);
			$ecommerce->scanned = 'YES';
			$ecommerce->scanned_date = date("Y-m-d H:i:s");
			$ecommerce->scanned_user = Auth::user()->username;
			$ecommerce->save();
			return Redirect::to('/ecommerce');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/ecommerce/scanned/'.$ecommerce->id);
		}
	}

	public function collected($id) 
	{
		try {
			$ecommerce = Ecommerce::findOrFail($id);
			$ecommerce->collected = 'YES';
			$ecommerce->collected_date = date("Y-m-d H:i:s");
			$ecommerce->collected_user = Auth::user()->username;
			$ecommerce->save();
			return Redirect::to('/ecommerce');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/ecommerce/collected/'.$ecommerce->id);
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
			$ecommerce = Ecommerce::findOrFail($id);
			$ecommerce->collected = 'YES';
			$ecommerce->scanned = 'YES';
			$ecommerce->shipped = 'YES';
			//$ecommerce->shipped_date = date("Y-m-d H:i:s");
			$ecommerce->shipped_date = $date;
			$ecommerce->shipped_user = Auth::user()->username;
			$ecommerce->temp_coloumn = $comment;
			$ecommerce->save();
			return Redirect::to('/ecommerce');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/ecommerce/shipped/'.$ecommerce->id);
		}
	}



}
