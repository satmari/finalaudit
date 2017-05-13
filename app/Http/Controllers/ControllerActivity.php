<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Authenticatable;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\ActivityLog;
use App\ActivityType;
use DB;
use Auth;
use App\User;

class ControllerActivity extends Controller {

	public function __construct()
	{	
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	public function index() 
	{	
	
		try {
			$name_id = Auth::user()->name_id;
			// dd($name_id);
			$user = User::find(Auth::id());
			
			if (($user->is('admin')) OR ($user->is('guest'))) {
				$activitylog = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM activity_log ORDER BY created_at asc"));
				return view('activity.index', compact('activitylog'));
			}

			if ($user->is('operator')) {

				$activitylog = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM activity_log WHERE status = 'Active' AND activity_by_id = '".$name_id."' ORDER BY created_at asc"));
				//dd($activitylog);

				if ($activitylog) {
					//dd('Activity exist for this user');
					//dd($activitylog);
					return view('activity.activityexist', compact('activitylog'));

				} else {
					
					//dd('Not set, choose new activity');

					$activity_types = ActivityType::orderBy('activity_id')->where('deleted','=',FALSE)->lists('activity_desc','id');
					return view('activity.activitynew', compact('activity_types'));
				}
			}

		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/activity');
		}
	}

	public function activity_insert(Request $request)
	{
		$this->validate($request, ['activity_type_id' => 'required']);
		$input = $request->all();

		$activity_id = $input['activity_type_id'];
		$activity_types = ActivityType::findOrFail($activity_id);

		$activity_type_id = $activity_types->activity_id;
		$activity_desc = $activity_types->activity_desc;

		$name_id = Auth::user()->name_id;
		$username = Auth::user()->username;

		try {

			$table = new ActivityLog;

			$table->activity_id = $activity_type_id;
			$table->activity_desc = $activity_desc;

			$table->activity_by_id = $name_id;
			$table->activity_by_name = $username;

			$table->start = date("Y-m-d H:i:s");
			$table->end;
			$table->duration_min;
			$table->duration_num;
			$table->status = 'Active';
					
			$table->save();

			return Redirect::to('/activity');
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			
			//return Redirect::to('/searchinteos');
			$msg = "Problem to save activity in table. try again.";
			return view('activity.error',compact('msg'));
		}
	}

	public function activity_stop($id) 
	{	

		try {
			$table = ActivityLog::findOrFail($id);

			$table->start;
			$table->end = date("Y-m-d H:i:s");

			$between = round(abs(strtotime($table->end) - strtotime($table->start)) / 60 , 0);
			// dd($between); 
			$between_num = (float)$between;
			// dd($between_num); 

			$table->duration_min; // ?
			$table->duration_num = $between_num; 

			$table->status = 'Closed';
			$table->save();
			
			return Redirect::to('/activity');

		}
		catch (\Illuminate\Database\QueryException $e) {
			//return Redirect::to('/searchinteos');
			$msg = "Problem to save activity in table. try again.";
			return view('activity.error',compact('msg'));
		}
	}

	public function index_type ()
	{
		$activity_types = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM activity_type WHERE deleted = 0 ORDER BY activity_id asc"));
		return view('activity.index_type', compact('activity_types'));
	}

	public function activity_type_new ()
	{
		return view('activity.activity_type_new');	
	}

	public function activity_type_insert(Request $request)
	{
		$this->validate($request, ['activity_id' => 'required', 'activity_desc' => 'required']);
		$input = $request->all();

		$activity_id = $input['activity_id'];
		$activity_desc = $input['activity_desc'];
		$activity_desc1 = $input['activity_desc1'];
		$activity_desc2 = $input['activity_desc2'];

		try {

			$table = new ActivityType;

			$table->activity_id = $activity_id;
			$table->activity_desc = $activity_desc;
			$table->activity_desc1 = $activity_desc1;
			$table->activity_desc2 = $activity_desc2;
			$table->deleted = FALSE;
			
			$table->save();

			return Redirect::to('/activity_type');
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			
			//return Redirect::to('/searchinteos');
			$msg = "Problem to save activity_type in table. try again.";
			return view('activity.error',compact('msg'));
		}
	}

	public function activity_type_edit($id)
	{	
		$activity_type = ActivityType::findOrFail($id);
		return view('activity.activity_type_edit', compact('activity_type'));
	}

	public function activity_type_update($id, Request $request)
	{

		$this->validate($request, ['activity_id' => 'required', 'activity_desc' => 'required']);
		$input = $request->all();

		$activity_id = $input['activity_id'];
		$activity_desc = $input['activity_desc'];
		$activity_desc1 = $input['activity_desc1'];
		$activity_desc2 = $input['activity_desc2'];

		try {
			$table = ActivityType::findOrFail($id);

			$table->activity_id = $activity_id;
			$table->activity_desc = $activity_desc;
			$table->activity_desc1 = $activity_desc1;
			$table->activity_desc2 = $activity_desc2;
			$table->save();

			return Redirect::to('/activity_type');
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			
			//return Redirect::to('/searchinteos');
			$msg = "Problem to save activity_type in table. try again.";
			return view('activity.error',compact('msg'));
		}
	}

	public function activity_type_delete($id)
	{
		$table = ActivityType::findOrFail($id);
		$table->deleted = TRUE;
		$table->save();

		return Redirect::to('/activity_type');
	}



}
