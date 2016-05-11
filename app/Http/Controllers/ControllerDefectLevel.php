<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\DefectLevel;
use DB;

class ControllerDefectLevel extends Controller {

	public function index()
	{
		//
		$defect_levels = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect_levels ORDER BY defect_level_id asc"));
		return view('defectlevel.index', compact('defect_levels'));
	}

	public function create()
	{
		//
		return view('defectlevel.create');
	}

	public function insert(Request $request)
	{
		//
		$this->validate($request, ['defect_level_id'=>'required','defect_level_name'=>'required','defect_level_rejected' => 'required']);

		$defect_level_input = $request->all(); // change use (delete or comment user Requestl; )
		
		$defect_level_id = $defect_level_input['defect_level_id'];
		$defect_level_name = $defect_level_input['defect_level_name'];
		$defect_level_rejected = $defect_level_input['defect_level_rejected'];
		//pcs_rejected = $defect_level_input['pcs_rejected'];
		
		try {
			$defect_level = new DefectLevel;

			$defect_level->defect_level_id = $defect_level_id;
			$defect_level->defect_level_name = $defect_level_name;
			$defect_level->defect_level_rejected = $defect_level_rejected;
			//$defect_level->pcs_rejected = $pcs_rejected;
			
			$defect_level->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('defectlevel.error');			
		}
		
		//return view('defectlevel.index');
		return Redirect::to('/defectlevel');

	}

	public function edit($id) {

		$defect_level = DefectLevel::findOrFail($id);		
		return view('defectlevel.edit', compact('defect_level'));
	}

	public function update($id, Request $request) {
		//
		$this->validate($request, ['defect_level_id'=>'required','defect_level_name'=>'required','defect_level_rejected' => 'required']);

		$defect_level = DefectLevel::findOrFail($id);		
		//$defect_level->update($request->all());

		$input = $request->all(); 
		//dd($input);

		try {
			//$defect_level->id = $input['id'];
			$defect_level->defect_level_id = $input['defect_level_id'];
			$defect_level->defect_level_name = $input['defect_level_name'];
			$defect_level->defect_level_rejected = $input['defect_level_rejected'];
			//$defect_level->pcs_rejected = $input['pcs_rejected'];
					
			$defect_level->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('defectlevel.error');			
		}
		
		return Redirect::to('/defectlevel');
	}

	public function delete($id) {

		$defect_level = DefectLevel::findOrFail($id);
		$defect_level->delete();

		return Redirect::to('/defectlevel');
	}

}
