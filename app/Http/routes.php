<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::get('/addadmin', 'addRollController@addadmin');
Route::get('/addoperator', 'addRollController@addoperator');
Route::get('/addguest', 'addRollController@addguest');

Route::get('/defectlevel', 'ControllerDefectLevel@index');
Route::get('/defectlevel_new', 'ControllerDefectLevel@create');
Route::post('/defectlevel_insert', 'ControllerDefectLevel@insert');
Route::get('/defectlevel/edit/{id}', 'ControllerDefectLevel@edit');
Route::post('/defectlevel/{id}', 'ControllerDefectLevel@update');
Route::get('/defectlevel/delete/{id}', 'ControllerDefectLevel@delete');
Route::post('/defectlevel/delete/{id}', 'ControllerDefectLevel@delete');

Route::get('/defecttype', 'ControllerDefectType@index');
Route::get('/defecttype_new', 'ControllerDefectType@create');
Route::post('/defecttype_insert', 'ControllerDefectType@insert');
Route::get('/defecttype/edit/{id}', 'ControllerDefectType@edit');
Route::post('/defecttype/{id}', 'ControllerDefectType@update');
Route::get('/defecttype/delete/{id}', 'ControllerDefectType@delete');
Route::post('/defecttype/delete/{id}', 'ControllerDefectType@delete');

Route::get('/category', 'ControllerCategory@index');
Route::get('/category_new', 'ControllerCategory@create');
Route::post('/category_insert', 'ControllerCategory@insert');
Route::get('/category/edit/{id}', 'ControllerCategory@edit');
Route::post('/category/{id}', 'ControllerCategory@update');
Route::get('/category/delete/{id}', 'ControllerCategory@delete');
Route::post('/category/delete/{id}', 'ControllerCategory@delete');

Route::get('/categorydefecttype', 'ControllerCategoryDefectType@index');
Route::get('/categorydefecttype_new', 'ControllerCategoryDefectType@create');
Route::post('/categorydefecttype_insert', 'ControllerCategoryDefectType@insert');
//Route::get('/categorydefecttype/edit/{id}', 'ControllerCategoryDefectType@edit');
//Route::post('/categorydefecttype/{id}', 'ControllerCategoryDefectType@update');
Route::get('/categorydefecttype/delete/{id}', 'ControllerCategoryDefectType@delete');
Route::post('/categorydefecttype/delete/{id}', 'ControllerCategoryDefectType@delete');

Route::get('/position', 'ControllerPosition@index');
Route::get('/position_new', 'ControllerPosition@create');
Route::post('/position_insert', 'ControllerPosition@insert');
Route::get('/position/edit/{id}', 'ControllerPosition@edit');
Route::post('/position/{id}', 'ControllerPosition@update');
Route::get('/position/delete/{id}', 'ControllerPosition@delete');
Route::post('/position/delete/{id}', 'ControllerPosition@delete');

Route::get('/categoryposition', 'ControllerCategoryPosition@index');
Route::get('/categoryposition_new', 'ControllerCategoryPosition@create');
Route::post('/categoryposition_insert', 'ControllerCategoryPosition@insert');
//Route::get('/categoryposition/edit/{id}', 'ControllerCategoryPosition@edit');
//Route::post('/categoryposition/{id}', 'ControllerCategoryPosition@update');
Route::get('/categoryposition/delete/{id}', 'ControllerCategoryPosition@delete');
Route::post('/categoryposition/delete/{id}', 'ControllerCategoryPosition@delete');

Route::get('/machine', 'ControllerMachine@index');
Route::get('/machine_new', 'ControllerMachine@create');
Route::post('/machine_insert', 'ControllerMachine@insert');
Route::get('/machine/edit/{id}', 'ControllerMachine@edit');
Route::post('/machine/{id}', 'ControllerMachine@update');
Route::get('/machine/delete/{id}', 'ControllerMachine@delete');
Route::post('/machine/delete/{id}', 'ControllerMachine@delete');

Route::get('/model', 'ControllerModel@index');
Route::get('/model_new', 'ControllerModel@create');
Route::post('/model_insert', 'ControllerModel@insert');
Route::get('/model/edit/{id}', 'ControllerModel@edit');
Route::post('/model/{id}', 'ControllerModel@update');
Route::get('/model/delete/{id}', 'ControllerModel@delete');
Route::post('/model/delete/{id}', 'ControllerModel@delete');

Route::get('/batch_t', 'ControllerBatch_t@index');
Route::get('/batch_t_new', 'ControllerBatch_t@create');
Route::post('/batch_t_insert', 'ControllerBatch_t@insert');
Route::get('/batch_t/edit/{id}', 'ControllerBatch_t@edit');
Route::post('/batch_t/{id}', 'ControllerBatch_t@update');
Route::get('/batch_t/delete/{id}', 'ControllerBatch_t@delete');
Route::post('/batch_t/delete/{id}', 'ControllerBatch_t@delete');

Route::get('/batch_i', 'ControllerBatch_i@index');
Route::get('/batch_i_new', 'ControllerBatch_i@create');
Route::post('/batch_i_insert', 'ControllerBatch_i@insert');
Route::get('/batch_i/edit/{id}', 'ControllerBatch_i@edit');
Route::post('/batch_i/{id}', 'ControllerBatch_i@update');
Route::get('/batch_i/delete/{id}', 'ControllerBatch_i@delete');
Route::post('/batch_i/delete/{id}', 'ControllerBatch_i@delete');

Route::get('/batch_c', 'ControllerBatch_c@index');
Route::get('/batch_c_new', 'ControllerBatch_c@create');
Route::post('/batch_c_insert', 'ControllerBatch_c@insert');
Route::get('/batch_c/edit/{id}', 'ControllerBatch_c@edit');
Route::post('/batch_c/{id}', 'ControllerBatch_c@update');
Route::get('/batch_c/delete/{id}', 'ControllerBatch_c@delete');
Route::post('/batch_c/delete/{id}', 'ControllerBatch_c@delete');

Route::get('/batch_t_bulk', 'ControllerBatch_t_bulk@index');
Route::get('/batch_t_bulk_new', 'ControllerBatch_t_bulk@create');
Route::post('/batch_t_bulk_insert', 'ControllerBatch_t_bulk@insert');
Route::get('/batch_t_bulk/edit/{id}', 'ControllerBatch_t_bulk@edit');
Route::post('/batch_t_bulk/{id}', 'ControllerBatch_t_bulk@update');
Route::get('/batch_t_bulk/delete/{id}', 'ControllerBatch_t_bulk@delete');
Route::post('/batch_t_bulk/delete/{id}', 'ControllerBatch_t_bulk@delete');

Route::get('/batch_i_bulk', 'ControllerBatch_i_bulk@index');
Route::get('/batch_i_bulk_new', 'ControllerBatch_i_bulk@create');
Route::post('/batch_i_bulk_insert', 'ControllerBatch_i_bulk@insert');
Route::get('/batch_i_bulk/edit/{id}', 'ControllerBatch_i_bulk@edit');
Route::post('/batch_i_bulk/{id}', 'ControllerBatch_i_bulk@update');
Route::get('/batch_i_bulk/delete/{id}', 'ControllerBatch_i_bulk@delete');
Route::post('/batch_i_bulk/delete/{id}', 'ControllerBatch_i_bulk@delete');

Route::get('/batch_c_bulk', 'ControllerBatch_c_bulk@index');
Route::get('/batch_c_bulk_new', 'ControllerBatch_c_bulk@create');
Route::post('/batch_c_bulk_insert', 'ControllerBatch_c_bulk@insert');
Route::get('/batch_c_bulk/edit/{id}', 'ControllerBatch_c_bulk@edit');
Route::post('/batch_c_bulk/{id}', 'ControllerBatch_c_bulk@update');
Route::get('/batch_c_bulk/delete/{id}', 'ControllerBatch_c_bulk@delete');
Route::post('/batch_c_bulk/delete/{id}', 'ControllerBatch_c_bulk@delete');

Route::get('/batch', 'ControllerBatch@index');
//Route::get('/batch_new', 'ControllerBatch@create');
//Route::post('/batch_insert', 'ControllerBatch@insert');
Route::get('/batch/edit/{id}', 'ControllerBatch@edit');
Route::get('/batch/edit_status/{id}', 'ControllerBatch@edit_status');
Route::post('/batch/edit_status_update/{id}', 'ControllerBatch@edit_status_update');
// Route::post('/batch/{id}', 'ControllerBatch@update');
Route::get('/batch/delete/{id}', 'ControllerBatch@delete');
Route::post('/batch/delete/{id}', 'ControllerBatch@delete');
Route::get('/searchinteos', 'ControllerBatch@searchinteos');
Route::post('/searchinteos_store', 'ControllerBatch@searchinteos_store');
Route::get('/batch/checkbarcode/{name}', 'ControllerBatch@batch_checkbarcode');
Route::post('/batch/checkbarcode_store', 'ControllerBatch@batch_checkbarcode_store');
Route::get('/batch/confirm/{id}', 'ControllerBatch@confirm');
Route::get('/batch/accept/{id}', 'ControllerBatch@accept');
Route::get('/batch/acceptwithreservetion/{id}', 'ControllerBatch@acceptwithreservetion');
Route::get('/batch/reject/{id}', 'ControllerBatch@reject');
Route::get('/batch/suspend/{id}', 'ControllerBatch@suspend');
Route::get('/batch/not_checked/{id}', 'ControllerBatch@not_checked');

// Batch BULK
Route::get('/batch_bulk', 'ControllerBatch_bulk@index');
Route::get('/selectproducertype', 'ControllerBatch_bulk@selectproducertype');
Route::post('/selectproducer', 'ControllerBatch_bulk@selectproducer');
Route::get('/searchinteos_bulk', 'ControllerBatch_bulk@searchinteos_bulk');
Route::post('/searchinteos_bulk', 'ControllerBatch_bulk@searchinteos_bulk');
Route::post('/searchinteos_store_bulk', 'ControllerBatch_bulk@searchinteos_store_bulk');
Route::post('/stop_store_bulk', 'ControllerBatch_bulk@stop_store_bulk');
Route::post('/stop_producer_store_bulk', 'ControllerBatch_bulk@stop_producer_store_bulk');
// Route::get('/batch_bulk/edit/{id}', 'ControllerBatch_bulk@edit');
Route::get('/batch_bulk/edit_status/{id}', 'ControllerBatch_bulk@edit_status');
Route::post('/batch_bulk/edit_status_update/{id}', 'ControllerBatch_bulk@edit_status_update');
Route::get('/batch_bulk/confirm/{id}', 'ControllerBatch_bulk@confirm');
Route::get('/batch_bulk/accept/{id}', 'ControllerBatch_bulk@accept');
Route::get('/batch_bulk/acceptwithreservetion/{id}', 'ControllerBatch_bulk@acceptwithreservetion');
Route::get('/batch_bulk/reject/{id}', 'ControllerBatch_bulk@reject');
Route::get('/batch_bulk/suspend/{id}', 'ControllerBatch_bulk@suspend');
Route::get('/batch_bulk/not_checked/{id}', 'ControllerBatch_bulk@not_checked');
Route::get('/batch_bulk/delete/{id}', 'ControllerBatch_bulk@delete');

// CB to repair
Route::get('/cb_to_repair', 'ControllerBatch@cb_to_repair');
Route::get('/cb_to_repair/edit/{id}', 'ControllerBatch@cb_to_repair_edit');
Route::post('/cb_to_repair/reparied/{id}', 'ControllerBatch@cb_to_repair_repair');
Route::get('/cb_to_repair/edit_date/{id}', 'ControllerBatch@cb_to_repair_edit_date');
Route::post('/cb_to_repair/repair_date/{id}', 'ControllerBatch@cb_to_repair_repair_date');

// Batch BULK to repar
Route::get('/cb_to_repair_bulk', 'ControllerBatch_bulk@cb_to_repair_bulk');
Route::get('/cb_to_repair_bulk/edit/{id}', 'ControllerBatch_bulk@cb_to_repair_bulk_edit');
Route::post('/cb_to_repair_bulk/reparied/{id}', 'ControllerBatch_bulk@cb_to_repair_bulk_repair');


Route::get('/garment', 'ControllerGarment@index');
//Route::get('/garment_new', 'ControllerGarment@create');
//Route::post('/garment_insert', 'ControllerGarment@insert');
Route::get('/garment/edit/{id}', 'ControllerGarment@edit');
Route::get('/garment/by_batch/{batch_name}', 'ControllerGarment@by_batch');
Route::get('/garment/checkbarcode/{name}', 'ControllerGarment@garment_checkbarcode');
Route::post('/garment/checkbarcode_store', 'ControllerGarment@garment_checkbarcode_store');

// Route::get('/garment_bulk', 'ControllerGarment_bulk@index');
// Route::get('/garment_new', 'ControllerGarment_bulk@create');
// Route::post('/garment_insert', 'ControllerGarment_bulk@insert');
// Route::get('/garment_bulk/edit/{id}', 'ControllerGarment_bulk@edit');
Route::get('/garment_bulk/by_batch/{batch_name}', 'ControllerGarment_bulk@by_batch');
Route::get('/garment_bulk/checkbarcode/{name}', 'ControllerGarment_bulk@garment_checkbarcode');
Route::post('/garment_bulk/checkbarcode_store', 'ControllerGarment_bulk@garment_checkbarcode_store');

Route::get('/defect', 'ControllerDefect@index');
Route::get('/defect_new/{garment_name}', 'ControllerDefect@newdefect');
Route::post('/defect_insert', 'ControllerDefect@insert');
Route::get('/defect/edit/{id}', 'ControllerDefect@edit');
Route::get('/defect/by_garment/{garment_name}', 'ControllerDefect@by_garment');
Route::get('/defect/delete/{id}', 'ControllerDefect@delete');
Route::post('/defect/delete/{id}', 'ControllerDefect@delete');

Route::get('/defect_bulk', 'ControllerDefect_bulk@index');
Route::get('/defect_bulk_new/{garment_name}', 'ControllerDefect_bulk@newdefect');
Route::post('/defect_bulk_insert', 'ControllerDefect_bulk@insert');
// Route::get('/defect_bulk/edit/{id}', 'ControllerDefect_bulk@edit');
Route::get('/defect_bulk/by_garment/{garment_name}', 'ControllerDefect_bulk@by_garment');
Route::get('/defect_bulk/delete/{id}', 'ControllerDefect_bulk@delete');
// Route::post('/defect_bulk/delete/{id}', 'ControllerDefect_bulk@delete');

// Import
Route::get('/import', 'ControllerImport@index');
Route::post('/import2', 'ControllerImport@postImportUser');
Route::post('/import3', 'ControllerImport@postImportRoll');
Route::post('/import4', 'ControllerImport@postImportUserRole');
Route::post('/import5', 'ControllerImport@postImportEcommerce');
Route::post('/import6', 'ControllerImport@postImportSizeset');

//NotCheck
Route::get('/notcheck', 'ControllerNotCheck@index');
Route::get('/notcheck/{batch_name}', 'ControllerNotCheck@main');

//Samples
Route::get('/ecommerce', 'ControllerEcommerce@index');
Route::get('/ecommerce_all', 'ControllerEcommerce@ecommerce_all');
Route::get('/ecommerce/edit/{id}', 'ControllerEcommerce@edit');
Route::post('/ecommerce/{id}', 'ControllerEcommerce@update');
Route::post('/ecommerce/scanned/{id}', 'ControllerEcommerce@scanned');
Route::post('/ecommerce/collected/{id}', 'ControllerEcommerce@collected');
Route::post('/ecommerce/shipped/{id}', 'ControllerEcommerce@shipped');

// Sizeset
Route::get('/sizeset', 'ControllerSizeset@index');
Route::get('/sizeset_all', 'ControllerSizeset@sizeset_all');
Route::get('/sizeset/edit/{id}', 'ControllerSizeset@edit');
Route::post('/sizeset/{id}', 'ControllerSizeset@update');
Route::post('/sizeset/scanned/{id}', 'ControllerSizeset@scanned');
Route::post('/sizeset/collected/{id}', 'ControllerSizeset@collected');
Route::post('/sizeset/shipped/{id}', 'ControllerSizeset@shipped');

// Activity
Route::get('/activity', 'ControllerActivity@index');
// Route::get('/activityexist', 'ControllerActivity@activityexist');
// Route::get('/activitynew', 'ControllerActivity@activitynew');
Route::post('/activity_insert', 'ControllerActivity@activity_insert');
Route::get('/activity_stop/{id}', 'ControllerActivity@activity_stop');

Route::get('/activity_type', 'ControllerActivity@index_type');
Route::get('/activity_type_new', 'ControllerActivity@activity_type_new');
Route::post('/activity_type_insert', 'ControllerActivity@activity_type_insert');
Route::get('/activity_type/{id}', 'ControllerActivity@activity_type_edit');
Route::post('/activity_type/update/{id}', 'ControllerActivity@activity_type_update');
Route::post('/activity_type/delete/{id}', 'ControllerActivity@activity_type_delete');

// Producer

Route::get('/producer', 'ControllerProducer@index');
Route::get('/producer_new', 'ControllerProducer@create');
Route::post('/producer_insert', 'ControllerProducer@insert');
Route::get('/producer/edit/{id}', 'ControllerProducer@edit');
Route::post('/producer/{id}', 'ControllerProducer@update');
Route::get('/producer/delete/{id}', 'ControllerProducer@delete');
Route::post('/producer/delete/{id}', 'ControllerProducer@delete');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);