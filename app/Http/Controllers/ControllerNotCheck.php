<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Batch;
use App\Garment;
use App\Defect;
use App\Category;
use DB;
use Auth;
use App\User;

class ControllerNotCheck extends Controller {

	public function __construct()
	{	
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	public function index()
	{
		//
		try {
			return view('batch.searchinteos');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch.searchinteos');
		}
	}

	public function main($batch_name)
	{
		//
		try {

			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT id,style,color,size,batch_user,batch_barcode_match FROM batch WHERE batch_name = '".$batch_name."'"));
			$batch_barcode_match = $batch[0]->batch_barcode_match;
			
		} catch (Exception $e) {
			$msg = "(Javi IT sektoru)";
			return view('batch.error',compact('msg'));
		}

		return view('batch.notcheckpage', compact('batch','batch_barcode_match'));	

	}

}
