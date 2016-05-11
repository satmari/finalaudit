<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Batch_is;
use DB;

class ControllerBatch_i extends Controller {

	public function index()
	{
		//
		$batch_i = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch_is ORDER BY batch_id asc"));
		return view('batch_i.index', compact('batch_i'));
	}

	public function create()
	{
		//
		return view('batch_i.create');
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
			$batch = new Batch_is;

			$batch->batch_id = $batch_id;
			$batch->batch_min = $batch_min;
			$batch->batch_max = $batch_max;
			$batch->batch_check = $batch_check;
			$batch->batch_reject = $batch_reject;
						
			$batch->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch_i.error');
		}
		
		return Redirect::to('/batch_i');

	}

	public function edit($id) {

		$batch_i = Batch_is::findOrFail($id);		
		return view('batch_i.edit', compact('batch_i'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['batch_id'=>'required','batch_min'=>'required','batch_max'=>'required','batch_check'=>'required','batch_reject'=>'required']);

		$batch = Batch_is::findOrFail($id);		
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
			return view('batch_i.error');			
		}
		
		return Redirect::to('/batch_i');
	}

	public function delete($id) {

		$batch_i = Batch_is::findOrFail($id);
		$batch_i->delete();

		return Redirect::to('/batch_i');
	}

}
