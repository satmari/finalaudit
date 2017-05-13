<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use DB;
use Auth;
use Session;

use App\User;
use App\Producer;

class ControllerProducer extends Controller {

	public function index()
	{
		//
		$producer = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM producers ORDER BY producer_id asc"));
		return view('producer.index', compact('producer'));
	}

	public function create()
	{
		//
		return view('producer.create');
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['producer_id'=>'required','producer_name'=>'required','producer_type'=>'required']);

		$input = $request->all();
		
		$producer_id = $input['producer_id'];
		$producer_name = $input['producer_name'];
		$producer_type = $input['producer_type'];
				
		try {
			$producer = new Producer;

			$producer->producer_id = $producer_id;
			$producer->producer_name = $producer_name;
			$producer->producer_type = $producer_type;
						
			$producer->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('producer.error');
		}
		
		return Redirect::to('/producer');

	}

	public function edit($id) {

		$producer = Producer::findOrFail($id);		
		return view('producer.edit', compact('producer'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['producer_id'=>'required','producer_name'=>'required','producer_type'=>'required']);

		$input = $request->all(); 
		
		try {
			$producer = Producer::findOrFail($id);	

			$producer->producer_id = $input['producer_id'];
			$producer->producer_name = $input['producer_name'];
			$producer->producer_type = $input['producer_type'];
						
			$producer->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('producer.error');			
		}
		
		return Redirect::to('/producer');
	}

	public function delete($id) {

		$producer = Producer::findOrFail($id);
		$producer->delete();

		return Redirect::to('/producer');
	}
	

}
