<?php namespace App\Http\Controllers;

use App\User;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use Illuminate\Support\Facades\Redirect;
use Auth;

use App\Sizeset;
use App\Ecommerce;
use DB;

use Session;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{	
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{	
		//
		$msg = '';
		$user = User::find(Auth::id());
		// dd($user->username);
		// if ($user->is('admin')) { // you can pass an id or slug
		//     // or alternatively $user->hasRole('admin')
		//     $msg = "I am Admin";
		// }
		
		// dd($user);

		// if ($user->isAdmin()) {
		//     $msg = $msg + " admin";
		// }

		// return redirect('/batch');
		
		if ($user->is('operator')) { 

			$ecommerce = DB::table('ecommerce')
			                    ->where('scanned', '=', 'YES')
			                    ->where('collected', '=', 'NO')
			                    ->count();

			$sizeset = DB::table('sizeset')
			                    ->where('scanned', '=', 'YES')
			                    ->where('collected', '=', 'NO')
			                    ->count();

		} else if ($user->is('planer')) { 
			
			$ecommerce = DB::table('ecommerce')
			                    ->where('collected', '=', 'YES')
			                    ->where('shipped', '=', 'NO')
			                    ->count();

			$sizeset = DB::table('sizeset')
			                    ->where('collected', '=', 'YES')
			                    ->where('shipped', '=', 'NO')
			                    ->count();

		} else {

			$sizeset = NULL;
			$ecommerce = NULL;

		}
		

		// dd($sizeset);
		
		if ($user->is('admin')) { 
		    // if user has at least one role
		    $msg = "Hi admin";
		}
		if ($user->is('operator')) { 
		    // if user has at least one role
		    $msg = "Hi statistica operator";
		    //Get from session-----------------

		    return redirect('/batch')/*->with(compact('sizeset','ecommerce'))*/;
		}
		if ($user->is('notcheck')) { 
		    // if user has at least one role
		    $msg = "Hi Not check operator";
		    return redirect('/notcheck')/*->with(compact('sizeset','ecommerce'))*/;
		}
		if ($user->is('planer')) { 
		    // if user has at least one role
		    $msg = "Hi Planer";
		    //return redirect('/');
		}
		if ($user->is('guest')) { 
		    // if user has at least one role
		    $msg = "Hi Guest";
		    //return redirect('/');
		}
	
		// return redirect('/home')->with(compact('msg'/*,'sizeset','ecommerce'*/));
		return view('home', compact('msg'));
	}

}
