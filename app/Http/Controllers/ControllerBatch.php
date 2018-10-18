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
																WHERE (batch.deleted = 0) AND created_at >= DATEADD(day,-30,GETDATE())
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
																WHERE (batch.deleted = 0) AND created_at >= DATEADD(day,-20,GETDATE())
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

		// Test database
		// $inteos = DB::connection('sqlsrv2')->select(DB::raw("SELECT [CNF_BlueBox].INTKEY,[CNF_BlueBox].IntKeyPO,[CNF_BlueBox].BlueBoxNum,[CNF_BlueBox].BoxQuant, [CNF_PO].POnum,[CNF_SKU].Variant,[CNF_SKU].ClrDesc,[CNF_STYLE].StyCod FROM [BdkCLZGtest].[dbo].[CNF_BlueBox] FULL outer join [BdkCLZGtest].[dbo].CNF_PO on [CNF_PO].INTKEY = [CNF_BlueBox].IntKeyPO FULL outer join [BdkCLZGtest].[dbo].[CNF_SKU] on [CNF_SKU].INTKEY = [CNF_PO].SKUKEY FULL outer join [BdkCLZGtest].[dbo].[CNF_STYLE] on [CNF_STYLE].INTKEY = [CNF_SKU].STYKEY WHERE [CNF_BlueBox].INTKEY =  :somevariable"), array(
		// 	'somevariable' => $inteosbbcode,
		// ));

		// Live database
		// try {
			
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
			
			[CNF_Modules].ModNam
			
			FROM [BdkCLZG].[dbo].[CNF_CartonBox]

			FULL outer join [BdkCLZG].[dbo].[CNF_PO] on [CNF_PO].INTKEY = [CNF_CartonBox].IntKeyPO
			FULL outer join [BdkCLZG].[dbo].[CNF_BlueBox] on [CNF_BlueBox].INTKEY = [CNF_CartonBox].BBalternativ
			FULL outer join [BdkCLZG].[dbo].[CNF_Modules] on [CNF_Modules].Module = [CNF_CartonBox].Module
			FULL outer join [BdkCLZG].[dbo].[CNF_SKU] on [CNF_SKU].INTKEY = [CNF_PO].SKUKEY
			FULL outer join [BdkCLZG].[dbo].[CNF_STYLE] on [CNF_STYLE].INTKEY = [CNF_SKU].STYKEY
			
			where BoxNum = :somevariable"), array(
			'somevariable' => $cbcode,
			));

			// dd($inteos);
			
			if ($inteos) {
				//continue
			} else {
	        	$msg = 'Cannot find CB in Inteos, NE POSTOJI KARTONSKA KUTIJA U INTEOSU !';
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
			
	    	$cartonbox = $cbcode;	//$inteos_array[0]['BoxNum'];
	    	$cartonbox_qty = $inteos_array[0]['BoxQuant'];
	    	$cartonbox_produced = $inteos_array[0]['Produced'];
	    	if ($cartonbox_produced > 0) {
				//continue
			} else {
				$msg = 'Carton box have 0 quantity inside, KUTIJA IMA 0 KOMADA! ';
	        	return view('batch.error', compact('msg'));
			}

	    	$cartonbox_status = $inteos_array[0]['CB_Status'];
	    	if ($cartonbox_status == "Completed") {
				//continue
			} else {
				$msg = 'Carton box is NOT completed in Inteos (on Module), KUTIJA NIJE ZAVRSENA U MODULU! ';
	        	return view('batch.error', compact('msg'));
			}

	    	$cartonbox_start_date_tmp = $inteos_array[0]['CREATEDATE'];
	    	$timestamp_s = strtotime($cartonbox_start_date_tmp);
			$cartonbox_start_date = date('Y-m-d H:i:s', $timestamp_s);
	    	$cartonbox_finish_date_tmp = $inteos_array[0]['EDITDATE'];
	    	$timestamp_f = strtotime($cartonbox_finish_date_tmp);
			$cartonbox_finish_date = date('Y-m-d H:i:s', $timestamp_f);

	    	$bluebox = $inteos_array[0]['BlueBoxNum']; 	
	    	
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
				$msg = 'This SKU not exist in Ecommerce table, OVAJ SKU NE POSTOJI U E-commerce TABELI !!! Zovi Marijanu.';
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

						try {
							$sizeset = Sizeset::findOrFail($sizeset_sample_one[0]->id);
							$sizeset->scanned = 'YES';
							$sizeset->scanned_date = date("Y-m-d H:i:s");
							$sizeset->scanned_user = Auth::user()->username;
							// $sizeset->style_scanned = $style_scanned;
							$sizeset->save();
							
							// $msg1 = $msg1.' This Item scanned first time for sizeset! PROIZVOD PRVI PUT SKENIRAN I ODABRAN ZA UZORAK ZA SIZESET!';
							//$msg2 = '';
						}
						catch (\Illuminate\Database\QueryException $e) {
							$msg = "Problem to save in sizeset table";
							return view('batch.error',compact('msg'));
						}
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
					$msg = $msg.' This SKU not exist in sizeset table, OVAJ SKU NE POSTOJI U Sizeset TABELI !!! Zovi Marijanu.';
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
				
				$table->cartonbox = $cartonbox;
				$table->cartonbox_qty = $cartonbox_qty;
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
			
			return Redirect::to('/batch/checkbarcode/'.$batch_name.'/'.$module_name);

		// }
		// catch (\Illuminate\Database\QueryException $e) {
		// 	//return Redirect::to('/searchinteos');
		// 	$msg = "Problem to save batch in table. try agan.";
		// 	return view('batch.error',compact('msg'));
		// }	
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

			if ($count_box[0]->count_box == "YES") {
				
				return view('batch.count_box',compact('batch_name','msg1'));
				
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

			if ($batch_brand_max_reject < $total_rejected_garments) {
				$suggestion = "Reject";
				return view('batch.confirm',compact('batch','batchid','garments','defects','total_defects','total_rejected_defects','total_rejected_garments','suggestion'));
			} else {
				$suggestion = "Accept";
				return Redirect::to('/batch/accept/'.$batchid->id);
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
			$batch->save();
			return Redirect::to('/batch/');
		}
		catch (\Illuminate\Database\QueryException $e) {
			return Redirect::to('/batch/accept/'.$id);
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
}
