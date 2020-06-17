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
use App\Ecommerce;
use App\Sizeset;
use App\ActivityLog;
use DB;
use Auth;
use App\User;

class ControllerBatch extends Controller {

	public function __construct()
	{	
		// Auth::loginUsingId(5);
		$this->middleware('auth');
	}

	public function index()
	{
		//
		try {
			$name_id = Auth::user()->name_id;
			// dd($name_id);
			$user = User::find(Auth::id());
			
			if (($user->is('admin')) OR ($user->is('guest'))) { 
			    
			    //$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch WHERE deleted = 0 ORDER BY id asc"));

			     $batch = DB::connection('sqlsrv')->select(DB::raw("SELECT 
																*,
																(SELECT COUNT(garment.batch_name) FROM garment WHERE garment.batch_name = batch.batch_name AND garment.garment_status = 'Rejected') as RejectedCount
																FROM batch 
																WHERE (batch.deleted = 0) AND created_at >= DATEADD(day,-45,GETDATE())
																ORDER BY batch.id desc"));

			    $batch_date = date("Ymd");
	    		
			    $total_checked_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->count();
				// dd($total_checked_batch);
			    $total_checked_batch_tezenis = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('brand', '=', 'TEZENIS')
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->count();
				// dd($total_checked_batch_tezenis);
			    $total_checked_batch_inti = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('brand', '=', 'INTIMISSIMI')
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->count();
				// dd($total_checked_batch_inti);

			    $total_accept_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Accept')
			                    ->count();
				// dd($total_accept_batch);

			    $total_reject_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Reject')
			                    ->count();
				// dd($total_reject_batch);

			    $total_suspend_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Suspend')
			                    ->count();
				// dd($total_suspend_batch);

			    $total_not_checked_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Not checked')
			                    ->count();
				// dd($total_not_checked_batch);

				$total_garments_today = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->sum('batch_qty');
				// dd($total_suspend_batch);		

				$total_garments_not_today = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Not checked')
			                    ->sum('batch_qty');
				// dd($total_garments_not_today);	                    

				return view('batch.index', compact('batch','total_checked_batch','total_accept_batch','total_reject_batch','total_suspend_batch', 'total_not_checked_batch', 'total_garments_today','total_garments_not_today','total_checked_batch_tezenis','total_checked_batch_inti'));
			}
			if ($user->is('operator')) { 
			    
			    //$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch WHERE batch_user = '".$name_id."' AND deleted = 0 ORDER BY id asc"));
				
			    $batch = DB::connection('sqlsrv')->select(DB::raw("SELECT 
																*,
																(SELECT COUNT(garment.batch_name) FROM garment WHERE garment.batch_name = batch.batch_name AND garment.garment_status = 'Rejected') as RejectedCount
																FROM batch 
																WHERE (batch.batch_user = '".$name_id."') AND 
																(batch.deleted = 0) AND 
																((CAST(batch.created_at AS DATE) = CAST(GETDATE() AS DATE)) OR
																((batch.batch_status = 'Pending') OR (batch.batch_status = 'Suspend')))
																ORDER BY batch.id asc"));
				
				/* // with mandatory to check
			    $batch = DB::connection('sqlsrv')->select(DB::raw("SELECT 
																*,
																(SELECT COUNT(garment.batch_name) FROM garment WHERE garment.batch_name = batch.batch_name AND garment.garment_status = 'Rejected') as RejectedCount,
																(SELECT mandatory_to_check FROM models WHERE models.model_name = batch.style) as to_check
																FROM batch 
																WHERE (batch.batch_user = '".$name_id."') AND 
																(batch.deleted = 0) AND 
																((CAST(batch.created_at AS DATE) = CAST(GETDATE() AS DATE)) OR ((batch.batch_status = 'Pending') OR (batch.batch_status = 'Suspend') /* OR (batch.batch_status = 'Not checked'))) 
																ORDER BY batch.id asc"));
				*/

			    // dd($batch);
				// $total_checked_garments =  DB::connection('sqlsrv')->select(DB::raw("SELECT (COUNT(*))
				//  											    FROM garment
				//  												JOIN batch ON batch.batch_name = garment.batch_name
				//  											    WHERE (CAST(garment.created_at AS DATE) = CAST(GETDATE() AS DATE)) AND batch.batch_user = '".$name_id."')"));

			    $batch_date = date("Ymd");
	    		$batch_user = $name_id;

			    $total_checked_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->where('deleted', '=', 0)
			                    ->count();
				// dd($total_checked_batch);

			    $total_checked_batch_tezenis = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('brand', '=', 'TEZENIS')
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->count();
				// dd($total_checked_batch_tezenis);
			    $total_checked_batch_inti = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('brand', '=', 'INTIMISSIMI')
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->count();
				// dd($total_checked_batch_inti);

			    $total_accept_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Accept')
			                    ->count();
				// dd($total_accept_batch);

			    $total_reject_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Reject')
			                    ->count();
				// dd($total_reject_batch);

			    $total_suspend_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Suspend')
			                    ->count();
				// dd($total_suspend_batch);

			    $total_not_checked_batch = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Not checked')
			                    ->count();
				// dd($total_not_checked_batch);

			    $total_garments_today = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '!=', 'Not checked')
			                    ->sum('batch_qty');
				// dd($total_suspend_batch);

			    $total_garments_not_today = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->where('deleted', '=', 0)
			                    ->where('batch_status', '=', 'Not checked')
			                    ->sum('batch_qty');
				// dd($total_garments_not_today);
			    
		 		$activity = DB::table('activity_log')
			                    ->where('activity_by_id', '=', $batch_user)
			                    ->where('status', '=', 'Active')
			                    ->count();
			    //dd($activity);

				return view('batch.index', compact('batch','total_checked_batch','total_accept_batch','total_reject_batch','total_suspend_batch', 'total_not_checked_batch', 'total_garments_today','total_garments_not_today','activity','total_checked_batch_tezenis','total_checked_batch_inti'));
			}
			
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch');
		}
	}

	public function history()
	{
		$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT *,
																(SELECT COUNT(garment.batch_name) FROM garment WHERE garment.batch_name = batch.batch_name AND garment.garment_status = 'Rejected') as RejectedCount
																FROM batch 
																WHERE (batch.deleted = 0) AND created_at >= DATEADD(day,-45,GETDATE())
																ORDER BY batch.id desc"));
		return view('batch.indexhistory', compact('batch'));
	}

	public function searchinteos()
	{
		//
		try {
			return view('batch.searchinteos');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch.searchinteos');
		}
	}

	public function searchinteos_store(Request $request)
	{	
		//
		$this->validate($request, ['cb_code' => 'required|min:12|max:13']);

		$input = $request->all(); // change use (delete or comment user Requestl; )
		//

		$cbcode = $input['cb_code'];
		// dd($cbcode);
		
		$msg = '';
		$msg1 = '';
		//$msg2 = '';

		// Live database
		// try {
			if (substr($cbcode, 0, 2) == '70') {

				$inteos = DB::connection('sqlsrv2')->select(DB::raw("SELECT 	
				/*[CNF_CartonBox].IntKeyPO, */
				[CNF_CartonBox].BoxNum,
				[CNF_CartonBox].BoxQuant,
				[CNF_CartonBox].Produced,
				(CASE	WHEN [CNF_CartonBox].Status = '0' THEN 'New' 
						WHEN [CNF_CartonBox].Status = '20' THEN 'On Module' 
						WHEN [CNF_CartonBox].Status = '99' THEN 'Completed'
				END) AS CB_Status,
				/*[CNF_CartonBox].Module, */
				/*[CNF_CartonBox].BBcreated, */
				/*[CNF_CartonBox].BBalternativ,*/
				[CNF_CartonBox].CREATEDATE,
				[CNF_CartonBox].EDITDATE,

				[CNF_BlueBox].BlueBoxNum,
				
				/*[CNF_PO].BoxComplete,*/
				/*[CNF_PO].BoxQuant,*/
				/*[CNF_PO].Line,*/
				[CNF_PO].POnum,

				/*[CNF_SKU].StyDesc,*/
				[CNF_SKU].Variant,
				/*[CNF_SKU].ClrDesc,*/
				
				[CNF_STYLE].StyCod,
				
				[CNF_Modules].ModNam,
				[CNF_WareHouse].BoxQuant as wh_qty
				
				FROM [BdkCLZG].[dbo].[CNF_CartonBox]

				FULL outer join [BdkCLZG].[dbo].[CNF_PO] on [CNF_PO].INTKEY = [CNF_CartonBox].IntKeyPO
				FULL outer join [BdkCLZG].[dbo].[CNF_BlueBox] on [CNF_BlueBox].INTKEY = [CNF_CartonBox].BBalternativ
				FULL outer join [BdkCLZG].[dbo].[CNF_Modules] on [CNF_Modules].Module = [CNF_CartonBox].Module
				FULL outer join [BdkCLZG].[dbo].[CNF_SKU] on [CNF_SKU].INTKEY = [CNF_PO].SKUKEY
				FULL outer join [BdkCLZG].[dbo].[CNF_STYLE] on [CNF_STYLE].INTKEY = [CNF_SKU].STYKEY
				FULL outer join [BdkCLZG].[dbo].[CNF_WareHouse] on [CNF_WareHouse].BoxNum = [CNF_CartonBox].BoxNum
				
				where [CNF_CartonBox].BoxNum = :somevariable"), array(
				'somevariable' => $cbcode,
				));

				// dd($inteos);
				
				if ($inteos) {
					//continue
				} else {
		        	$msg = 'Cannot find CB in Subotica Inteos, NE POSTOJI KARTONSKA KUTIJA U Subotica INTEOSU !';
		        	return view('batch.error', compact('msg'));
		    	}

		    } elseif (substr($cbcode, 0, 2) == '71') {

		    	$inteos = DB::connection('sqlsrv5')->select(DB::raw("SELECT 	
				/*[CNF_CartonBox].IntKeyPO, */
				[CNF_CartonBox].BoxNum,
				[CNF_CartonBox].BoxQuant,
				[CNF_CartonBox].Produced,
				(CASE	WHEN [CNF_CartonBox].Status = '0' THEN 'New' 
						WHEN [CNF_CartonBox].Status = '20' THEN 'On Module' 
						WHEN [CNF_CartonBox].Status = '99' THEN 'Completed'
				END) AS CB_Status,
				/*[CNF_CartonBox].Module, */
				/*[CNF_CartonBox].BBcreated, */
				/*[CNF_CartonBox].BBalternativ,*/
				[CNF_CartonBox].CREATEDATE,
				[CNF_CartonBox].EDITDATE,

				[CNF_BlueBox].BlueBoxNum,
				
				/*[CNF_PO].BoxComplete,*/
				/*[CNF_PO].BoxQuant,*/
				/*[CNF_PO].Line,*/
				[CNF_PO].POnum,

				/*[CNF_SKU].StyDesc,*/
				[CNF_SKU].Variant,
				/*[CNF_SKU].ClrDesc,*/
				
				[CNF_STYLE].StyCod,
				
				[CNF_Modules].ModNam,
				[CNF_WareHouse].BoxQuant as wh_qty
				
				FROM [BdkCLZKKA].[dbo].[CNF_CartonBox]

				FULL outer join [BdkCLZKKA].[dbo].[CNF_PO] on [CNF_PO].INTKEY = [CNF_CartonBox].IntKeyPO
				FULL outer join [BdkCLZKKA].[dbo].[CNF_BlueBox] on [CNF_BlueBox].INTKEY = [CNF_CartonBox].BBalternativ
				FULL outer join [BdkCLZKKA].[dbo].[CNF_Modules] on [CNF_Modules].Module = [CNF_CartonBox].Module
				FULL outer join [BdkCLZKKA].[dbo].[CNF_SKU] on [CNF_SKU].INTKEY = [CNF_PO].SKUKEY
				FULL outer join [BdkCLZKKA].[dbo].[CNF_STYLE] on [CNF_STYLE].INTKEY = [CNF_SKU].STYKEY
				FULL outer join [BdkCLZKKA].[dbo].[CNF_WareHouse] on [CNF_WareHouse].BoxNum = [CNF_CartonBox].BoxNum
				
				where [CNF_CartonBox].BoxNum = :somevariable"), array(
				'somevariable' => $cbcode,
				));

				// dd($inteos);
				
				if ($inteos) {
					//continue
					// dd($inteos);
					
				} else {
		        	$msg = 'Cannot find CB in Kikinda Inteos, NE POSTOJI KARTONSKA KUTIJA U Kikinda INTEOSU !';
		        	return view('batch.error', compact('msg'));
		    	}


		    } else {

		    	$msg = 'Cannot find CB in ANY Inteos, NE POSTOJI KARTONSKA KUTIJA U NIJEDNOM INTEOSU !';
		        return view('batch.error', compact('msg'));

		    }



			function object_to_array($data)
			{
			    if (is_array($data) || is_object($data))
			    {
			        $result = array();
			        foreach ($data as $key => $value)
			        {
			            $result[$key] = object_to_array($value);
			        }
			        return $result;
			    }
			    return $data;
			}
		
	    	$inteos_array = object_to_array($inteos);

	    	if (Auth::check())
			{
				$name_id = Auth::user()->name_id;
			    $username = Auth::user()->username;
			} else {
				$msg = 'User is not autenticated';
				return view('batch.error',compact('msg'));
			}

	    	$checked_by_name = $username;
	    	$checked_by_id = $name_id;
	    	//dd($name_id);
	    	$batch_date = date("Ymd");
	    	$batch_user = $name_id;

	    	$today_batch_byuser = DB::table('batch')
			                    ->where('batch_date', '=', $batch_date)
			                    ->where('batch_user', '=', $batch_user)
			                    ->count();

		   	$batch_order_num = $today_batch_byuser + 1;
		   	$batch_order = str_pad($batch_order_num, 3, "0", STR_PAD_LEFT); 
		   	
	    	$batch_name = $batch_date."-".$batch_user."-".$batch_order;
	    	
	    	$style = $inteos_array[0]['StyCod'];
	    	$variant = $inteos_array[0]['Variant'];
	    	$sku = $style." ".$variant;

	    	$brlinija = substr_count($variant,"-");
			// echo $brlinija." ";

			if ($brlinija == 2)
			{
				list($color, $size1, $size2) = explode('-', $variant);
				$size = $size1."-".$size2;
				// echo $color." ".$size;	
			} else {
				list($color, $size) = explode('-', $variant);
				// echo $color." ".$size;
			}

	    	// list($color, $size) = explode('-', $variant);
	    	$po = $inteos_array[0]['POnum'];

	  		//$brand = substr($po, 2, 1); // T;I;C

	  		// NAV - PO information
			$nav = DB::connection('sqlsrv4')->select(DB::raw("SELECT [Cutting Prod_ Line] as Flash
				  FROM [Gordon_LIVE].[dbo].[GORDON\$Production Order]
				  WHERE [No_] = :po"
				), array(
					'po' => $po
			));

			if (isset($nav[0]->Flash)) {
				$flash = $nav[0]->Flash;
			} else {
				$flash = '';
			}
			
			$models = DB::connection('sqlsrv')->select(DB::raw("SELECT category_name,category_id,model_brand,mandatory_to_check FROM models WHERE model_name = '".$style."'"));
			
	    	if ($models) {
	    		$brand = $models[0]->model_brand;
				$category_name = $models[0]->category_name;
				$category_id = $models[0]->category_id;
				$mandatory_to_check = $models[0]->mandatory_to_check;
			} else {
	        	$msg = 'Cannot find Style '.$style.' in Model table, NE POSTOJI MODEL '.$style.' U TABELI!!!';
	        	return view('batch.error', compact('msg'));
	    	}

	    	/* If User in NotCheck */
	    	if ($mandatory_to_check == "YES" AND $name_id == '10') {
	    		$msg = 'This Style '.$style.' is MANDATORY to check, OVAJ MODEL SE MORA PREGLEDATI!!! ';
	        	return view('batch.error', compact('msg'));
	    	}

	    	$module_name = $inteos_array[0]['ModNam'];
	    	// dd($module_name);
	    	if ($module_name == NULL) {
	    		$module_name = "EXTERNAL";
	    	}

	    	// Bonus relevant
	    	// if ( (substr($module_name, 0, 1) == 'S') OR (substr($module_name, 0, 1) == 'K')) {
	    	if (substr($module_name, 0, 1) == 'S') {
	    		$bonus_relevant = NULL;	
	    	} else {
	    		$bonus_relevant = 'IGNORE';
	    	}
	    	
			
	    	$cartonbox = $cbcode;	//$inteos_array[0]['BoxNum'];
	    	$cartonbox_qty = $inteos_array[0]['BoxQuant'];
	    	$cartonbox_produced = $inteos_array[0]['Produced'];

	    	if ($cartonbox_produced > 0) {
				//continue
			} else {

				if ($inteos_array[0]['wh_qty'] != NULL) {
					// dd('ima wh qty');
					$cartonbox_produced = intval($inteos_array[0]['wh_qty']);
					$inteos_array[0]['Produced'] = intval($inteos_array[0]['wh_qty']);
					// dd($cartonbox_produced);
				} else {

					$msg = 'Carton box have 0 quantity inside, KUTIJA IMA 0 KOMADA! ';
		        	return view('batch.error', compact('msg'));	
				}
			}

	    	$cartonbox_status = $inteos_array[0]['CB_Status'];
	    	
	    	if ($cartonbox_status == "Completed") {
				//continue
			} else {
				if (($inteos_array[0]['wh_qty']) > 0) {
					$cartonbox_status = "Completed";
				} else {
					$msg = 'Carton box is NOT completed in Inteos (on Module), KUTIJA NIJE ZAVRSENA U MODULU! ';
		        	return view('batch.error', compact('msg'));
				 }
			}

	    	$cartonbox_start_date_tmp = $inteos_array[0]['CREATEDATE'];
	    	$timestamp_s = strtotime($cartonbox_start_date_tmp);
			$cartonbox_start_date = date('Y-m-d H:i:s', $timestamp_s);
	    	$cartonbox_finish_date_tmp = $inteos_array[0]['EDITDATE'];
	    	$timestamp_f = strtotime($cartonbox_finish_date_tmp);
			$cartonbox_finish_date = date('Y-m-d H:i:s', $timestamp_f);

			if (isset($inteos_array[0]['BlueBoxNum'])) {
				if ($inteos_array[0]['BlueBoxNum'] != NULL) {
					$bluebox = 'NULL';	
				} else {
					$bluebox = $inteos_array[0]['BlueBoxNum'];
				}	 
			} else {
				$bluebox = 'NULL';
			}

			// dd($bluebox);
	    	if ($brand == "TEZENIS") {
				$batch_brand = "batch_ts";
			} elseif ($brand == "INTIMISSIMI") {
				$batch_brand = "batch_is";
			} elseif ($brand == "CALZEDONIA") {
				$batch_brand = "batch_cs";
			} 
	    	
	    	$batch_brand_table = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM ".$batch_brand." WHERE batch_min <= '".$cartonbox_produced."' AND batch_max >= '".$cartonbox_produced."'"));
			// dd($batch_brand_table);

		  	if ($batch_brand_table) {
		  		$batch_qty = $batch_brand_table[0]->batch_check;
		  		$batch_brand_id = $batch_brand_table[0]->batch_id;
		  		$batch_brand_min = $batch_brand_table[0]->batch_min;
		  		$batch_brand_max = $batch_brand_table[0]->batch_max;
		  		$batch_brand_max_reject = $batch_brand_table[0]->batch_reject;
			} else {
		      	$msg = 'Cannot find proper line in Batch table for this Brand, OVA KOLICINA NIJE DEFINISANA U TABELI ZA OVAJ BREND!!!';
		      	return view('batch.error', compact('msg'));
		  	}

			$rejected = 0; // exist but not used ?
			//$batch_status = "Pending"; // new batch // no Pending anymore
			$batch_status = "Suspend"; // new batch have Suspend status

			// dd("Sample");

			///////// Samples Ecommerce ///////////
			$ecommerce_sample = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM ecommerce WHERE style = '".$style."' AND size = '".$size."' AND color = '".$color."' "));
			
			if ($ecommerce_sample) {
				$scanned = $ecommerce_sample[0]->scanned;
				
				if ($scanned == 'NO') {

					try {
						$ecommerce = Ecommerce::findOrFail($ecommerce_sample[0]->id);
						$ecommerce->scanned = 'YES';
						$ecommerce->scanned_date = date("Y-m-d H:i:s");
						$ecommerce->scanned_user = Auth::user()->username;
						$ecommerce->save();
						
						//return Redirect::to('/');
						$msg1 = 'This Item scanned first time for e-commerce! PROIZVOD PRVI PUT SKENIRAN I ODABRAN ZA UZORAK E-COMMERCE!';
		      			//return view('batch.sample', compact('msg','batch_name'));
					}
					catch (\Illuminate\Database\QueryException $e) {
						$msg = "Problem to save in ecommerce table";
						return view('batch.error',compact('msg'));
					}
				}
				
			} else {
				$msg = 'This SKU not exist in Ecommerce table, OVAJ SKU NE POSTOJI U E-commerce TABELI !!! Zovi Zlatka.';
		      	// return view('batch.error', compact('msg'));
			}
			

			///////// Samples Sizeset ///////////
			
			if ($brand == "TEZENIS") {

				$sizeset_sample = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE style = '".$style."' AND size = '".$size."' "));

				if ($sizeset_sample) {

					$scanned_color = $sizeset_sample[0]->color;
					$scanned = $sizeset_sample[0]->scanned;

					//if color in table is not set
					if ($scanned_color == '' OR $scanned_color == NULL) {
						
						$sizeset_sample_style = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE style = '".$style."' "));	

						//set color for each style
						foreach ($sizeset_sample_style as $size_line) {

							try {
								$sizeset = Sizeset::findOrFail($size_line->id);
								$sizeset->color = $color;
								$sizeset->save();
							}
							catch (\Illuminate\Database\QueryException $e) {
								// $msg = "Problem to save in sizeset table";
								// return view('batch.error',compact('msg'));
							}
						}
					}
					//if sytle + size already scanned
					if ($scanned == 'NO') {

						try {
							$sizeset = Sizeset::findOrFail($sizeset_sample[0]->id);
							$sizeset->scanned = 'YES';
							$sizeset->scanned_date = date("Y-m-d H:i:s");
							$sizeset->scanned_user = Auth::user()->username;
							$sizeset->save();
							
							$msg1 = $msg1.' This Style scanned first time, should be taken for sizeset! PROIZVOD PRVI PUT SKENIRAN I ODABRAN ZA UZORAK ZA SIZESET!';
							//$msg2 = '';
						}
						catch (\Illuminate\Database\QueryException $e) {
							$msg = "Problem to save in sizeset table";
							return view('batch.error',compact('msg'));
						}
					}

				} else {
				// $msg = $msg.' This SKU not exist in sizeset table, OVAJ SKU NE POSTOJI U Sizeset TABELI !!!';
		 	 	// return view('batch.error', compact('msg'));
				}

			} elseif (($brand == "INTIMISSIMI") OR ($brand == "CALZEDONIA")) {

				$sizeset_sample_one = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE style = '".$style."' AND size = '".$size."' AND color = '".$color."' order by ID asc"));
				// dd($sizeset_sample_one);

				//if sytle + size already scanned
				if ($sizeset_sample_one) {

					if ($sizeset_sample_one[0]->scanned == 'NO') {
						// dd("NO");

						// try {
							$sizeset = Sizeset::findOrFail($sizeset_sample_one[0]->id);
							$sizeset->scanned = 'YES';
							$sizeset->scanned_date = date("Y-m-d H:i:s");
							$sizeset->scanned_user = Auth::user()->username;
							// $sizeset->style_scanned = $style_scanned;
							$sizeset->save();
							
							// $msg1 = $msg1.' This Item scanned first time for sizeset! PROIZVOD PRVI PUT SKENIRAN I ODABRAN ZA UZORAK ZA SIZESET!';
							//$msg2 = '';
						// }
						// catch (\Illuminate\Database\QueryException $e) {
						// 	$msg = "Problem to save in sizeset table";
						// 	return view('batch.error',compact('msg'));
						// }
						// dd("test");


						// dd($sizeset_sample_one[0]->style_scanned);

						if (is_null($sizeset_sample_one[0]->style_scanned)) {

							// dd("is null");
							
							$style_sample = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE style = '".$style."' "));

							// dd($style_sample);

							$new = 0;
							foreach ($style_sample as $line) {
								if ($line->style_scanned == 'NEW'){
									$new = $new + 1;
								}
							}

							// dd($new);

							if ($new > 0) {

								$style_color_sample = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE style = '".$style."' AND color = '".$color."' "));

								foreach ($style_color_sample as $line) {
									$sizeset = Sizeset::findOrFail($line->id);
									$sizeset->style_scanned = 'OLD';
									$sizeset->save();
								}

								// $msg1 = $msg1.' This Item + color scanned first time for sizeset! PROIZVOD PRVI PUT SKENIRAN I ODABRAN ZA UZORAK ZA SIZESET!';

							} else {

								$style_color_sample = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM sizeset WHERE style = '".$style."' AND color = '".$color."' "));



								foreach ($style_color_sample as $line) {
									$sizeset = Sizeset::findOrFail($line->id);
									$sizeset->style_scanned = 'NEW';
									$sizeset->save();
								}

								// $msg1 = $msg1.' This Item + color scanned first time for sizeset! PROIZVOD PRVI PUT SKENIRAN I ODABRAN ZA UZORAK ZA SIZESET!';
							}
						}
					}

				} else {
					$msg = $msg.' This SKU not exist in sizeset table, OVAJ SKU NE POSTOJI U Sizeset TABELI !!! Zovi Zlatka.';
			 	 	return view('batch.error', compact('msg'));
				}
			
				// if ($style_scanned == 'NEW') {
				// 	$msg1 = $msg1.' This Style scanned very first time for all colors (NEW), should be taken for sizeset! PROIZVOD PRVI PUT SKENIRAN U SVIM VARIJANTAMA (NEW) I ODABRAN ZA UZORAK SIZESET!';
				// } else {
				// 	$msg1 = $msg1.' This Style + Color scanned first time (OLD), should be taken for sizeset! PROIZVOD PRVI PUT SKENIRAN, ALI JE VEC SKENIRAN U DRUGOJ VARIJANTI (OLD) I ODABRAN ZA UZORAK SIZESET!';
				// }
				
			}


			// dd("record");
			
			///////// Record Batch ////////////

			try {
				$table = new Batch;

				$table->checked_by_name = $checked_by_name;
				$table->checked_by_id = $checked_by_id;
				
				$table->batch_name = $batch_name;
				$table->batch_date = $batch_date;
				$table->batch_user = $batch_user;
				$table->batch_order = $batch_order;
				$table->sku = $sku;
				$table->style = $style;
				$table->color = $color;
				$table->size = $size;
				$table->po = $po;
				$table->brand = $brand;
				$table->category_name = $category_name;
				$table->category_id = $category_id;
				$table->module_name = $module_name;
				// dd($module_name);
				$table->cartonbox = $cartonbox;
				// dd($cartonbox);
				$table->cartonbox_qty = $cartonbox_qty;
				// dd($cartonbox_produced);
				$table->cartonbox_produced = $cartonbox_produced;
				$table->cartonbox_status = $cartonbox_status;
				$table->cartonbox_start_date = $cartonbox_start_date;
				$table->cartonbox_finish_date = $cartonbox_finish_date;

				$table->bluebox = $bluebox;
				
				$table->batch_qty = $batch_qty;
				$table->batch_brand_id = $batch_brand_id;
				$table->batch_brand_min = $batch_brand_min;
				$table->batch_brand_max =  $batch_brand_max;
				$table->batch_brand_max_reject = $batch_brand_max_reject;

				$table->rejected = $rejected;

				$table->batch_status = $batch_status;

				$table->deleted = FALSE;

				$table->flash = $flash;
				$table->bonus_relevant = $bonus_relevant;
						
				$table->save();
			}
			catch (\Illuminate\Database\QueryException $e) {
				$msg = "Problem to save batch in table";
				return view('batch.error',compact('msg'));
			}
			

			// Record Garmets
			$batch_qty;

			for ($i=1; $i < $batch_qty+1 ; $i++) { 
				
				$times = $i; //1
				// dd($i);

				$garment_order = str_pad($i, 2, "0", STR_PAD_LEFT);
				$garment_name = $batch_date."-".$batch_user."-".$batch_order."-".$garment_order;
				$garment_status = "Accepted";

				try {
					$table = new Garment;

					$table->garment_name = $garment_name;
					$table->garment_order = $garment_order;
					$table->batch_name = $batch_name;
					$table->cartonbox = $cartonbox;
					$table->sku = $sku;
					$table->po = $po;
					$table->brand = $brand;
					$table->category_id = $category_id;
					$table->category_name = $category_name;
					$table->garment_status = $garment_status;
					$table->deleted = FALSE;
							
					$table->save();
				}
				catch (\Illuminate\Database\QueryException $e) {
					$msg = "Problem to save garment in table";
					return view('batch.error',compact('msg'));
				}
			}
			// return Redirect::to('/batch');
			//return Redirect::to('/garment/by_batch/'.$batch_name);

			if ($msg1 != ''){
				return view('batch.sample', compact('msg1','batch_name','module_name'));
			}
			
			return Redirect::to('/scan_cont/'.$batch_name.'/'.$module_name); // New scan QC operator
			// return Redirect::to('/batch/checkbarcode/'.$batch_name.'/'.$module_name); //Old

		// }
		// catch (\Illuminate\Database\QueryException $e) {
		// 	//return Redirect::to('/searchinteos');
		// 	$msg = "Problem to save batch in table. try agan.";
		// 	return view('batch.error',compact('msg'));
		// }	
	}

	public function scan_cont($name, $module) {

		try {
			return view('batch.scan_cont',compact('name','module'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch.scan_cont',compact('name','module'));
		}
	
	}

	public function scan_cont_post(Request $request) {

		$this->validate($request, ['batch_name' => 'required', 'audit' => 'required']);

		$input = $request->all(); 
		// dd($input);

		$batch_name = $input['batch_name'];
		$module_name = $input['module'];
		$audit = $input['audit'];

		$msg1 = '';

		$audit_check = strpos($audit,"R");
		if ($audit_check == 0) {
			// dd("First");
		} else {
			// dd("not first");
			$msg = "Barcode of audit or RS label is not correct!";
			return view('batch.error',compact('msg'));
		}

		// $audit_check = explode("R", $audit);
		// dd($audit_check);
		// dd(strlen($audit_check[1]));
		// if (strlen($audit_check[1]) == 5) {
			
		// 	// continue
		// } else {
		// 	$msg = "Barcode of audit is not correct!";
		// 	return view('batch.error',compact('msg'));
		// }
		// // dd($audit);

		$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT id FROM batch WHERE batch_name = '".$batch_name."'"));
		// dd($batch[0]->id);

		try {

			$b = Batch::findOrFail($batch[0]->id);
			$b->audit = $audit;
			$b->save();

		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to save audit in batch";
			return view('batch.error',compact('msg'));
		}

		return Redirect::to('/batch/checkbarcode/'.$batch_name.'/'.$module_name);
	
	}

	public function batch_checkbarcode ($name, $module)
	{
		try {
			return view('batch.checkbarcode',compact('name','module'));
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch.checkbarcode',compact('name','module'));
		}
	}

	public function batch_checkbarcode_store (Request $request)
	{
		//
		$this->validate($request, ['batch_name' => 'required', 'barcode' => 'required']);

		$input = $request->all(); 
		// dd($input);

		$batch_name = $input['batch_name'];
		$module = $input['module'];
		$barcode_insert = $input['barcode'];

		$msg1 = '';

		try {

			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT id,style,color,size,batch_user FROM batch WHERE batch_name = '".$batch_name."'"));
			$style = $batch[0]->style;
			$color = $batch[0]->color;
			$size = $batch[0]->size;
			$batch_user = $batch[0]->batch_user;

			$size_to_search = str_replace("/","-",$size);
					
			//$barcode = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM cartiglio WHERE Cod_Bar = '".$barcode."'"));
			$barcode = DB::connection('sqlsrv')->select(DB::raw("SELECT Cod_Bar FROM cartiglio WHERE Cod_Art_CZ = '".$style."' AND Cod_Col_CZ = '".$color."' AND Tgl_ITA = '".$size_to_search."'"));
			
			try {
				if(isset($barcode[0])) {
					if ($barcode[0]->Cod_Bar) {
					$barcode_indb = $barcode[0]->Cod_Bar;
					} else {
						$msg = "Item is not in Cartiglio table, PROIZVOD NE POSTOJI U Cartiglio BAZI!!! (Javi IT sektoru)";
						return view('batch.error',compact('msg'));
					}
				}
				else {
					$msg = "Item is not in Cartiglio table, PROIZVOD NE POSTOJI U Cartiglio BAZI!!! (Javi IT sektoru)";
					return view('batch.error',compact('msg'));
				}
			   	
			} catch (Exception $e) {
			    $msg = "Item is not in Cartiglio table, PROIZVOD NE POSTOJI U Cartiglio BAZI!!! (Javi IT sektoru)";
				return view('batch.error',compact('msg'));
			}

			if ($barcode_insert == $barcode_indb) {
				// dd("Barcode is Ok");
				$barcode_match = "YES";
			} else {
				// dd("Barcode is NOT Ok");
				$barcode_match = "NO";
			}

			$b = Batch::findOrFail($batch[0]->id);
			$b->batch_barcode_match = $barcode_match;
			$b->batch_barcode = $barcode_indb;
			$b->save();
		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Barcode not found in cartiglio database, PROIZVOD NE POSTOJI U Cartiglio BAZI!!! (Javi IT sektoru)";
			return view('batch.error',compact('msg'));
		}

		if ($barcode_insert != $barcode_indb) {
			$msg1 = "Barcode not match with barcode from cartiglio database, BARKODOVI SE NE SLAZU! ";
			// return view('batch.error_continue',compact('msg','batch_name'));
		}

		// Check if mandatory to check box quantity
		
		$count_box = DB::connection('sqlsrv')->select(DB::raw("SELECT count_box FROM modules WHERE module = '".$module."'"));
		//dd($count_box[0]->count_box);


		// user NotCheck
		if ($batch_user == '10') {

			return Redirect::to('/notcheck/'.$batch_name);

		} else {

			if (isset($count_box[0])) {

				if ($count_box[0]->count_box == "YES") {
					
					return view('batch.count_box',compact('batch_name','msg1'));
					
				} else {

					if ($msg1 == "") {
						return Redirect::to('/garment/by_batch/'.$batch_name);

					} else {
						return view('batch.error_continue',compact('msg1','batch_name'));			
					}
				}
			} else {

				if ($msg1 == "") {
					return Redirect::to('/garment/by_batch/'.$batch_name);

				} else {
					return view('batch.error_continue',compact('msg1','batch_name'));			
				}
			}
		}
	}

	public function count_box_store(Request $request) {
		//
		$this->validate($request, ['batch_name' => 'required', 'count_box' => 'required']);

		$input = $request->all(); 
		// dd($input);

		$batch_name = $input['batch_name'];
		$count_box = $input['count_box'];

		$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT id FROM batch WHERE batch_name = '".$batch_name."'"));
		// dd($batch[0]->id);

		try {

			$b = Batch::findOrFail($batch[0]->id);
			$b->count_qty = $count_box;
			
			$b->save();

		}
		catch (\Illuminate\Database\QueryException $e) {
			$msg = "Problem to find batch and save count_box";
			return view('batch.error',compact('msg'));
		}

		return Redirect::to('/garment/by_batch/'.$batch_name);	
	}

	public function inside()
	{
		//
		try {
			return view('batch.searchinteos');	
		}
		catch (\Illuminate\Database\QueryException $e) {
			return view('batch.searchinteos');		
		}
	}

	public function confirm($id) 
	{
		// 
		// dd($batchid->id);
		try {
			$batchid = Batch::findOrFail($id);
			// dd($batchid->id);
			$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM batch WHERE batch_name = '".$batchid->batch_name."'"));
			$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM garment WHERE batch_name = '".$batchid->batch_name."'"));
			$defects = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect WHERE batch_name = '".$batchid->batch_name."'"));

			$total_defects = DB::table('defect')
			                    ->where('batch_name', '=', $batchid->batch_name)
			                    ->where('deleted', '=', FALSE)
			                    ->count();

			$total_rejected_defects = DB::table('defect')
			                    	->where('batch_name', '=', $batchid->batch_name)
			                    	->where('deleted', '=', FALSE)
			                    	->where('defect_level_rejected', '=', "YES")
			                    	->count();

			$total_rejected_garments = DB::table('garment')
			                    	->where('batch_name', '=', $batchid->batch_name)
			                    	->where('deleted', '=', FALSE)
			                    	->where('garment_status', '=', "Rejected")
			                    	->count();

			foreach ($batch as $b) {
				$batch_brand_max_reject = $b->batch_brand_max_reject;
			}

			/*
			if ($batch_brand_max_reject < $total_rejected_garments) {
				$suggestion = "Reject";
				return view('batch.confirm',compact('batch','batchid','garments','defects','total_defects','total_rejected_defects','total_rejected_garments','suggestion'));
			} else {
				$suggestion = "Accept";
				return Redirect::to('/batch/accept/'.$batchid->id);
			}
			*/

			
			if ($total_rejected_garments == 0) {

				// dd("Accept");
				$suggestion = "Accept";
				return Redirect::to('/batch/accept/'.$batchid->id);

			} else if ($batch_brand_max_reject >= $total_rejected_garments) {

				// dd("Zamena");
				$suggestion = "Zamena";
				return Redirect::to('/batch/zamena/'.$batchid->id);

			} else {

				// dd("Reject");
				$suggestion = "Reject";
				return view('batch.confirm',compact('batch','batchid','garments','defects','total_defects','total_rejected_defects','total_rejected_garments','suggestion'));

			}
			
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/');
		}
	}

	public function accept($id) 
	{
		try {
			$batch = Batch::findOrFail($id);
			$batch->batch_status = "Accept";
			$batch->bonus_relevant = "IGNORE";
			$batch->save();
			return Redirect::to('/batch/');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/accept/'.$id);
		}
	}

	public function zamena($id) 
	{
		try {
			$batch = Batch::findOrFail($id);
			$batch->batch_status = "Zamena";
			
			$batch->save();
			return Redirect::to('/batch/');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/zamena/'.$id);
		}
	}

	public function acceptwithreservetion($id) 
	{
		try {
			$batch = Batch::findOrFail($id);
			$batch->batch_status = "Accept with reservation";
			$batch->save();
			return Redirect::to('/batch/');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/acceptwithreservetion/'.$id);
		}
	}

	public function edit_status ($id)
	{
		$batch = Batch::findOrFail($id);
		return view('batch.edit_status', compact('batch'));
	}

	public function edit_status_update ($id, Request $request)
	{
		$this->validate($request, ['batch_status' => 'required']);
		$input = $request->all(); 

		$batch_status = $input['batch_status'];

		if ($batch_status == 'Reject') {
			$repaired = "NO";

		} else {
			$repaired = NULL;	
		}

		try {
			$batch = Batch::findOrFail($id);
			$batch->batch_status = $batch_status;
			$batch->repaired = $repaired;
			$batch->repaired_by_id = NULL;
			$batch->repaired_by_name = NULL;
			$batch->repaired_date = NULL;

			$batch->save();
			return Redirect::to('/batch');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch');
		}
	}

	public function reject($id) 
	{
		try {
			$batch = Batch::findOrFail($id);
			$batch->batch_status = "Reject";
			$batch->repaired = "NO";
			// $batch->bonus_relevant = NULL;
			$batch->save();
			return Redirect::to('/batch/');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/reject/'.$id);
		}
	}

	public function suspend($id) 
	{
		try {
			$batch = Batch::findOrFail($id);
			$batch->batch_status = "Suspend";
			$batch->save();
			return Redirect::to('/batch/');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/suspend/'.$id);
		}
	}

	public function not_checked($id) 
	{
		// try {
			// Add status to batch
			$batch = Batch::findOrFail($id);
			$batch->batch_status = "Not checked";
			$batch->save();

			// $batch = DB::connection('sqlsrv')->select(DB::raw("UPDATE batch SET batch_status = 'Not checked' WHERE id = '".$id."' "));

			// Add status to garments inside batch
			$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT id FROM garment WHERE batch_name = '".$batch->batch_name."'"));
			foreach ($garments as $garment) {
				$gar = Garment::findOrFail($garment->id);
				$gar->garment_status = "Not checked";
				$gar->save();
			}
			

			//$garments = DB::connection('sqlsrv')->select(DB::raw("UPDATE garment SET garment_status = 'Not checked'	WHERE batch_name = '".$batch->batch_name."' "));

			$defects = DB::connection('sqlsrv')->select(DB::raw("SELECT id FROM defect WHERE batch_name = '".$batch->batch_name."'"));
			foreach ($defects as $defect) {
				$def = Defect::findOrFail($defect->id);
				$def->deleted = TRUE;
				$def->save();
			}

			//$defects = DB::connection('sqlsrv')->select(DB::raw("UPDATE defect SET deleted = 'TRUE'	WHERE batch_name = '".$batch->batch_name."'"));

			
			// user NotCheck
			$name_id = Auth::user()->name_id;
			
			if ($name_id == '10') {
				return Redirect::to('/');
			} else {
				return Redirect::to('/batch/');
			}

		// }
		// catch (\Illuminate\Database\QueryException $e) {
			// return Redirect::to('/batch/not_checked/'.$id);
		// }
	}

	public function delete($id) 
	{
		/*
		try {
			$batch = Batch::findOrFail($id);
			$batch->deleted = TRUE;
			$batch->batch_status = "Deleted";
			$batch->save();

			$garments = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM garment WHERE batch_name = '".$batch->batch_name."'"));
			foreach ($garments as $garment) {
				$gar = Garment::findOrFail($garment->id);
				$gar->deleted = TRUE;
				$gar->garment_status = "Deleted";
				$gar->save();
			}

			$defects = DB::connection('sqlsrv')->select(DB::raw("SELECT * FROM defect WHERE batch_name = '".$batch->batch_name."'"));
			foreach ($defects as $defect) {
				$def = Defect::findOrFail($defect->id);
				$def->deleted = TRUE;
				$def->save();
			}
			return Redirect::to('/batch');	
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/delete/'.$id);
		}
		*/
	}

	public function cb_to_repair()
	{
		$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT [id]
															      ,[batch_name]
															      ,[sku]
															      ,[po]
															      ,[module_name]
															      ,[cartonbox]
															      ,[batch_status]
															      ,[repaired]
															      ,[repaired_by_name]
															      ,[date_of_sending_to_repair]
															      ,[repaired_comment]
															      ,[flash]
															      ,[audit]
															  FROM [finalaudit].[dbo].[batch]
															  WHERE batch_status = 'Reject' AND [repaired] = 'NO'
															  ORDER BY [created_at] asc
															  "));

		return view('batch.cb_to_repair', compact('batch'));
	}

	public function cb_to_repair_edit($id)
	{
		$batch = Batch::findOrFail($id);
		return view('batch.cb_to_repair_update', compact('batch'));
	}

	public function cb_to_repair_repair($id, Request $request)
	{	
		
		try {
			$batch = Batch::findOrFail($id);
			$batch->repaired = "YES";
			$batch->repaired_by_name = Auth::user()->username;
			$batch->repaired_by_id = Auth::user()->name_id;
			$batch->repaired_date = date("Y-m-d H:i:s");
			
			$batch->save();
			return Redirect::to('/cb_to_repair');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/cb_to_repair');
		}
	}

	public function cb_to_repair_edit_date($id)
	{	
		$batch = Batch::findOrFail($id);
		return view('batch.cb_to_repair_update_date', compact('batch'));
	}

	public function cb_to_repair_repair_date($id, Request $request)
	{
		$this->validate($request, ['date_of_sending_to_repair' => 'required']);
		$input = $request->all(); 

		$date_of_sending_to_repair = $input['date_of_sending_to_repair'];

		try {
			$batch = Batch::findOrFail($id);
			$batch->date_of_sending_to_repair = $date_of_sending_to_repair;

			$batch->save();
			return Redirect::to('/cb_to_repair');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/cb_to_repair');
		}
	}

	public function cb_to_repair_edit_comment($id)
	{	
		$batch = Batch::findOrFail($id);
		return view('batch.cb_to_repair_update_comment', compact('batch'));
	}

	public function cb_to_repair_repair_comment($id, Request $request)
	{
		// $this->validate($request, ['comment' => 'required']);
		$input = $request->all(); 

		if (isset($input['comment'])) {
			$comment = $input['comment'];	
		} else {
			$comment = '';
		}

		
		try {
			$batch = Batch::findOrFail($id);
			$batch->repaired_comment = $comment;

			$batch->save();

			return Redirect::to('/cb_to_repair');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/cb_to_repair');
		}
	}

	
	public function bonus_relevant_page()
	{	
		return view('batch.bonus_relevant_page');
	}

	public function bonus_relevant_page_access(Request $request)
	{	
		$input = $request->all();
		$pass = $input['pass'];

		// dd($pass);
		if ($pass == '1234') {
			return Redirect::to('bonus_relevant');
		} 
	}
	

	public function bonus_relevant_table()
	{	
		// dd("test");
		$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT [id]
															      ,[batch_name]
															      ,[sku]
															      ,[po]
															      ,[module_name]
															      ,[cartonbox]
															      ,[batch_status]
															      ,[flash]
															      ,[batch_status]
															      ,[bonus_relevant]

															  FROM [finalaudit].[dbo].[batch]
															  WHERE batch_status = 'Reject' AND ([bonus_relevant] IS NULL) 
															  ORDER BY [created_at] asc
															  "));
		
		return view('batch.bonus_relevant', compact('batch'));
	}

	public function bonus_relevant_edit($id)
	{
		$batch = Batch::findOrFail($id);
		return view('batch.bonus_relevant_update', compact('batch'));
	}

	public function bonus_relevant_post($id, Request $request)
	{	
		
		$input = $request->all();

		try {
			$batch = Batch::findOrFail($id);
			$batch->bonus_relevant = $input['bonus'];
						
			$batch->save();
			return Redirect::to('/bonus_relevant');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/bonus_relevant');
		}
	}

	public function zamena_table()
	{	
		// dd("test");
		$batch = DB::connection('sqlsrv')->select(DB::raw("SELECT [id]
															      ,[batch_name]
															      ,[sku]
															      ,[po]
															      ,[module_name]
															      ,[cartonbox]
															      ,[batch_status]
															      ,[flash]
															      ,[batch_status]
															      

															  FROM [finalaudit].[dbo].[batch]
															  WHERE batch_status = 'Zamena'
															  ORDER BY [created_at] asc
															  "));
		
		return view('batch.zamena_table', compact('batch'));
	}

	public function zamena_post($id, Request $request)
	{	
		
		$input = $request->all();

		try {
			$batch = Batch::findOrFail($id);
			$batch->bonus_relevant = $input['bonus'];
						
			$batch->save();
			return Redirect::to('/bonus_relevant');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/bonus_relevant');
		}
	}

}
