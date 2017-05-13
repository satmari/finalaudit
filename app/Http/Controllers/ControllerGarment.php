<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Batch;
use App\Garment;
use App\Category;
use DB;
use Auth;

class ControllerGarment extends Controller {

	public function __construct()
	{
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	public function index()
	{
		//
		try {
			$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM garment ORDER BY id asc"));
			return view('garment.index_all', compact('garments'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/garment');
		}
	}

	public function by_batch($batch_name)
	{
		//
		try {
			//$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch WHERE batch_name = '".$batch_name."'"));

			// with mandatory to check
			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT 
																*,
																(SELECT mandatory_to_check FROM models WHERE models.model_name = batch.style) as to_check
																FROM batch 
																WHERE batch_name = '".$batch_name."'"));
			
			//$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM garment WHERE batch_name = '".$batch_name."' ORDER BY id asc"));

			$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT *,
				(SELECT COUNT(defect.garment_name) FROM defect WHERE ((defect.garment_name = garment.garment_name) AND (defect.deleted = 0))) as CountDefects,
				(SELECT COUNT(defect.garment_name) FROM defect WHERE ((defect.garment_name = garment.garment_name) AND (defect.defect_level_rejected = 'YES') AND (defect.deleted = 0))) as CountCriticalDefects
				FROM garment
				WHERE garment.batch_name = '".$batch_name."'
				ORDER BY garment.id asc "));

			return view('garment.index', compact('garments','batch'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/garment/by_batch/'.$batch_name);
		}
	}

	public function garment_checkbarcode ($name) 
	{
		$garment = DB::connection('sqlsrv')->select(DB::raw("SELECT garment_barcode_match FROM garment WHERE garment_name = '".$name."'"));

		if ($garment[0]->garment_barcode_match == NULL ) {
			return view('garment.checkbarcode',compact('name'));
		} else {
			return Redirect::to('/defect/by_garment/'.$name);
		}
	}

	public function garment_checkbarcode_store (Request $request) 
	{
		$this->validate($request, ['garment_name' => 'required', 'barcode' => 'required']);
		$input = $request->all(); 

		$garment_name = $input['garment_name'];
		$barcode_insert = $input['barcode'];

		try {

			// if you check barcode form batch barcode
			/*
			$garment = DB::connection('sqlsrv')->select(DB::raw("SELECT batch_name FROM garment WHERE garment_name = '".$garment_name."'"));		
			$batch_name = $garment[0]->batch_name;
			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT batch_barcode FROM batch WHERE batch_name = '".$batch_name."'"));
			$barcode = $batch[0]->batch_barcode;
			*/

			//if you check barcode from cartiglio database
			$garment = DB::connection('sqlsrv')->select(DB::raw("SELECT id,sku FROM garment WHERE garment_name = '".$garment_name."'"));		
			$sku = $garment[0]->sku; //1MC875 019-M

			$a = explode(' ', $sku);
			$style = $a[0];
			$b = explode('-', $a[1]);
			$color = $b[0];
			$size = $b[1];
			$size_to_search = str_replace("/","-",$size);

			$barcode = DB::connection('sqlsrv')->select(DB::raw("SELECT Cod_Bar FROM cartiglio WHERE Cod_Art_CZ = '".$style."' AND Cod_Col_CZ = '".$color."' AND Tgl_ITA = '".$size_to_search."'"));
			$barcode_indb = $barcode[0]->Cod_Bar;

			if ($barcode_insert == $barcode_indb) {
				// dd("Barcode is Ok");
				$barcode_match = "YES";
			} else {
				// dd("Barcode is NOT Ok");
				$barcode_match = "NO";
			}

			$b = Garment::findOrFail($garment[0]->id);
			$b->garment_barcode_match = $barcode_match;
			$b->garment_barcode = $barcode_indb;
			$b->save();

		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Barcode not found in cartiglio database";
			return view('garment.error',compact('msg'));
		}		

		if ($barcode_insert != $barcode_indb) {
			$msg = "Barcode not match with barcode from cartiglio database";
			return view('garment.error_continue',compact('msg','garment_name'));
		}
		return Redirect::to('/defect/by_garment/'.$garment_name);
		
		
	}

}
