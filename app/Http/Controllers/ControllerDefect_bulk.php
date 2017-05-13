<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Batch_bulk;
use App\Garment_bulk;
use App\Defect_bulk;
use App\Category;
use DB;
use Auth;

class ControllerDefect_bulk extends Controller {

	public function __construct()
	{
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	public function index()
	{
		//
		try {
			$defects = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_bulk ORDER BY id asc"));
			return view('defect_bulk.index_all', compact('defects'));	
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/defect_bulk');
		}

		
	}

	public function by_garment($garment_name)
	{
		//
		try {
			$defects = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_bulk WHERE (garment_name = '".$garment_name."' AND deleted = 0) ORDER BY id asc"));
			
			$num = 0;
			foreach ($defects as $defect) {
			 	if ($defect->defect_level_rejected == "YES") {
			 		$num = $num +1;
			 	}
			}


			$garment = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM garment_bulk WHERE garment_name = '".$garment_name."'"));
			//dd($garment[0]->batch_name);
			$batch_name = $garment[0]->batch_name;
			//dd($batch_name);
			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch_bulk WHERE batch_name = '".$batch_name."'"));
			
			return view('defect_bulk.index', compact('defects','garment','batch','num'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/defect_bulk/by_garment/'.$garment_name);
		}
		
	}

	public function newdefect($garment_name) {

		//
		try {
			$defects = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_bulk WHERE garment_name = '".$garment_name."' ORDER BY id asc"));
			$garment = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM garment_bulk WHERE garment_name = '".$garment_name."'"));
			$batch_name = $garment[0]->batch_name;
			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch_bulk WHERE batch_name = '".$batch_name."'"));
			
			$defect_types = DB::connection('sqlsrv')->select(DB::raw("SELECT
			g.id,
			dt.defect_type_id,
			dt.defect_type_name,
			dt.defect_level_rejected,
			c.category_name
			FROM defect_types as dt

			INNER JOIN category_defect_types as cdt ON cdt.defect_type_id = dt.defect_type_id
			INNER JOIN categories as c ON c.category_id = cdt.category_id
			INNER JOIN garment_bulk as g ON g.category_id = c.category_id

			WHERE g.garment_name = '".$garment_name."'

			GROUP BY
			g.id,
			dt.defect_type_id,
			dt.defect_type_name,
			dt.defect_level_rejected,
			c.category_name 
			"));
			//dd($defect_types);

			$positions = DB::connection('sqlsrv')->select(DB::raw("SELECT
			g.id,
			p.position_id,
			p.position_name,
			c.category_name
			FROM positions as p

			INNER JOIN category_positions as cp ON cp.position_id = cp.position_id
			INNER JOIN categories as c ON c.category_id = cp.category_id
			INNER JOIN garment_bulk as g ON g.category_id = c.category_id

			WHERE g.garment_name = '".$garment_name."'

			GROUP BY
			g.id,
			p.position_id,
			p.position_name,
			c.category_name 
			"));
			//dd($positions);

			$machines = DB::connection('sqlsrv')->select(DB::raw("SELECT id,machine_id,machine_type FROM machines"));
			//dd($machines);

			return view('defect_bulk.new', compact('defects','garment','batch','defect_types','positions','machines'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/defect_bulk_new/'.$garment_name);
		}

	}

	public function insert(Request $request)
	{
		//
		// dd("test");
		try {
			$this->validate($request, ['defect_type_id'=>'required']);

			$input = $request->all(); 
			// dd($input);

			$garment_name = $input['garment_name'];
			$garment_order = $input['garment_order'];
			$batch_name = $input['batch_name'];
			// $batch_date = $input['batch_date'];
			// $batch_user = $input['batch_user'];
			// $batch_order = $input['batch_order'];


			if(isset($input['defect_type_id'])){
				$defect_type_id = $input['defect_type_id'];	
				$defect_types = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_types WHERE defect_type_id = '".$defect_type_id."'"));
				$defect_type_name = $defect_types[0]->defect_type_name;
				$defect_level_id = $defect_types[0]->defect_level_id;
				$defect_level_name = $defect_types[0]->defect_level_name;
				$defect_level_rejected = $defect_types[0]->defect_level_rejected;
			} else {
				$msg = 'Cannot find Defect Type';
	        	return view('defect.error', compact('msg'));
			}
			
			if(isset($input['position_id'])){
				$position_id = $input['position_id'];	
				$positions = DB::connection('sqlsrv')->select(DB::raw("SELECT position_name FROM positions WHERE position_id = '".$position_id."'"));
				$position_name = $positions[0]->position_name;
			} else {
				$position_id = '';
				$position_name = '';
			}
			
			if(isset($input['machine_id'])) {
				$machine_id = $input['machine_id'];
				$machines = DB::connection('sqlsrv')->select(DB::raw("SELECT machine_type FROM machines	 WHERE machine_id = '".$machine_id."'"));
				$machine_type = $machines[0]->machine_type;
			} else {
				$machine_id = '';
				$machine_type = '';
			}

			$defect_order_bygarment = DB::table('defect_bulk')->where('garment_name', '=', $garment_name)->count();

		   	$defect_order_num = $defect_order_bygarment + 1;
		   	$defect_order = str_pad($defect_order_num, 3, "0", STR_PAD_LEFT);
		   	// dd($defect_order);

		   	$defect_name = $garment_name."-".$defect_order;

		   	try {
				$table = new Defect_bulk;

				$table->defect_name = $defect_name;
				$table->defect_order = $defect_order;

				$table->garment_name = $garment_name;
				$table->batch_name = $batch_name;

				// $table->batch_date = $batch_date;
				// $table->batch_user = $batch_user;
				// $table->batch_order = $batch_order;
				
				$table->defect_type_id = $defect_type_id;
				$table->defect_type_name = $defect_type_name;
				$table->defect_level_id = $defect_level_id;
				$table->defect_level_name = $defect_level_name;
				$table->defect_level_rejected = $defect_level_rejected;

				$table->position_id = $position_id;
				$table->position_name = $position_name;
				$table->machine_id = $machine_id;
				$table->machine_type = $machine_type;

				$table->deleted = FALSE;
						
				$table->save();

				// if ($defect_level_rejected == "YES") {
				// 	$affectedRows = Garment::where('garment_name', '=', $garment_name)->update(array('garment_status' => "Rejected"));
				// }
				
			}
			catch (\Illuminate\Database\QueryException $e) {

				// return Redirect::to('/defect/by_garment/'.$garment_name);
				$msg = "Problem to save defect in table";
				return view('defect.error',compact('msg'));
			}

			$garment_rejected_count = DB::table('defect_bulk')
			->where('garment_name', '=', $garment_name)
			->where('deleted', '=', FALSE)
			->where('defect_level_rejected', '=', "YES")->count();

			if ($garment_rejected_count > 0) {
				$affectedRows = Garment_bulk::where('garment_name', '=', $garment_name)->update(array('garment_status' => "Rejected"));
			} else {
				$affectedRows = Garment_bulk::where('garment_name', '=', $garment_name)->update(array('garment_status' => "Accepted"));
			}

			return Redirect::to('/defect_bulk/by_garment/'.$garment_name);
		}
		catch (\Illuminate\Database\QueryException $e) {
			//return Redirect::to('/defect/by_garment/'.$garment_name);

			$msg = "Problem to save defect in table, try again.";
			return view('defect.error',compact('msg'));
		}

	}

	public function delete($id) {

		try {
			$defect = Defect_bulk::findOrFail($id);
			$defect->deleted = TRUE;
			$defect->save();


			$garment_rejected_count = DB::table('defect_bulk')
			->where('garment_name', '=', $defect->garment_name)
			->where('deleted', '=', FALSE)
			->where('defect_level_rejected', '=', "YES")->count();

			// dd($garment_rejected_count);

			if ($garment_rejected_count > 0) {
				$affectedRows = Garment_bulk::where('garment_name', '=', $defect->garment_name)->update(array('garment_status' => "Rejected"));
			} else {
				$affectedRows = Garment_bulk::where('garment_name', '=', $defect->garment_name)->update(array('garment_status' => "Accepted"));
			}

			return Redirect::to('/defect_bulk/by_garment/'.$defect->garment_name);
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/defect_bulk/delete/'.$id);
		}
	}
}
