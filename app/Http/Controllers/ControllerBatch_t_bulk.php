<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Batch_ts_bulk;
use DB;

class ControllerBatch_t_bulk extends Controller {

	public function index()
	{
		//
		$batch_t = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch_ts_bulk ORDER BY batch_id asc"));
		return view('batch_t_bulk.index', compact('batch_t'));
	}

	public function create()
	{
		//
		return view('batch_t_bulk.create');
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['batch_id'=>'required','batch_min'=>'required','batch_max'=>'required','batch_check'=>'required','batch_reject'=>'required']);

		$input = $request->all(); // change use (delete or comment user Requestl; )
		
		$batch_id = $input['batch_id'];
		$batch_min = $input['batch_min'];
		$batch_max = $input['batch_max'];
		$batch_check = $input['batch_check'];
		$batch_reject = $input['batch_reject'];
				
		try {
			$batch = new Batch_ts_bulk;

			$batch->batch_id = $batch_id;
			$batch->batch_min = $batch_min;
			$batch->batch_max = $batch_max;
			$batch->batch_check = $batch_check;
			$batch->batch_reject = $batch_reject;
						
			$batch->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch_t_bulk.error');
		}
		
		//return view('defectlevel.index');
		return Redirect::to('/batch_t_bulk');

	}

	public function edit($id) {

		$batch_t = Batch_ts_bulk::findOrFail($id);		
		return view('batch_t_bulk.edit', compact('batch_t'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['batch_id'=>'required','batch_min'=>'required','batch_max'=>'required','batch_check'=>'required','batch_reject'=>'required']);

		$batch = Batch_ts_bulk::findOrFail($id);		
		//$machine->update($request->all());

		$input = $request->all(); 
		//dd($input);

		try {
			
			$batch->batch_id = $input['batch_id'];
			$batch->batch_min = $input['batch_min'];
			$batch->batch_max = $input['batch_max'];
			$batch->batch_check = $input['batch_check'];
			$batch->batch_reject = $input['batch_reject'];
						
			$batch->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch_t_bulk.error');			
		}
		
		return Redirect::to('/batch_t_bulk');
	}

	public function delete($id) {

		$batch_t = Batch_ts_bulk::findOrFail($id);
		$batch_t->delete();

		return Redirect::to('/batch_t_bulk');
	}

}
