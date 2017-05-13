<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Batch_bulk;
use App\Garment_bulk;
use App\Category;
use DB;
use Auth;

class ControllerGarment_bulk extends Controller {

	public function __construct()
	{
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	public function index()
	{
		//
		try {
			$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM garment_bulk ORDER BY id asc"));
			return view('garment_bulk.index_all', compact('garments'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/garment_bulk');
		}
	}

	public function by_batch($batch_name)
	{
		//
		try {
			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT *,
																(SELECT mandatory_to_check FROM models WHERE models.model_name = batch_bulk.style) as to_check
																FROM batch_bulk
																WHERE batch_name = '".$batch_name."'"));
			// dd($batch);
			
			$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT *,
				(SELECT COUNT(defect_bulk.garment_name) FROM defect_bulk WHERE ((defect_bulk.garment_name = garment_bulk.garment_name) AND (defect_bulk.deleted = 0))) as CountDefects,
				(SELECT COUNT(defect_bulk.garment_name) FROM defect_bulk WHERE ((defect_bulk.garment_name = garment_bulk.garment_name) AND (defect_bulk.defect_level_rejected = 'YES') AND (defect_bulk.deleted = 0))) as CountCriticalDefects
				FROM garment_bulk
				WHERE garment_bulk.batch_name = '".$batch_name."'
				ORDER BY garment_bulk.id asc "));

			return view('garment_bulk.index', compact('garments','batch'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/garment_bulk/by_batch/'.$batch_name);
		}
	}


	public function garment_checkbarcode ($name) 
	{
		$garment = DB::connection('sqlsrv')->select(DB::raw("SELECT garment_barcode_match FROM garment_bulk WHERE garment_name = '".$name."'"));

		if ($garment[0]->garment_barcode_match == NULL ) {
			return view('garment_bulk.checkbarcode',compact('name'));
		} else {
			return Redirect::to('/defect_bulk/by_garment/'.$name);
		}
	}

	public function garment_checkbarcode_store (Request $request) 
	{
		$this->validate($request, ['garment_name' => 'required', 'barcode' => 'required']);
		$input = $request->all(); 

		$garment_name = $input['garment_name'];
		$barcode_insert = $input['barcode'];

		try {

			//if you check barcode from cartiglio database
			$garment = DB::connection('sqlsrv')->select(DB::raw("SELECT id,sku FROM garment_bulk WHERE garment_name = '".$garment_name."'"));		
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

			$b = Garment_bulk::findOrFail($garment[0]->id);
			$b->garment_barcode_match = $barcode_match;
			$b->garment_barcode = $barcode_indb;
			$b->save();

		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Barcode not found in cartiglio database";
			return view('garment_bulk.error',compact('msg'));
		}		

		if ($barcode_insert != $barcode_indb) {
			$msg = "Barcode not match with barcode from cartiglio database";
			return view('garment_bulk.error_continue',compact('msg','garment_name'));
		}
		return Redirect::to('/defect_bulk/by_garment/'.$garment_name);
	
	}

}