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

Route::get('/batch', 'ControllerBatch@index');
//Route::get('/batch_new', 'ControllerBatch@create');
//Route::post('/batch_insert', 'ControllerBatch@insert');
Route::get('/batch/edit/{id}', 'ControllerBatch@edit');
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

Route::get('/garment', 'ControllerGarment@index');
//Route::get('/garment_new', 'ControllerGarment@create');
//Route::post('/garment_insert', 'ControllerGarment@insert');
Route::get('/garment/edit/{id}', 'ControllerGarment@edit');
Route::get('/garment/by_batch/{batch_name}', 'ControllerGarment@by_batch');
Route::get('/garment/checkbarcode/{name}', 'ControllerGarment@garment_checkbarcode');
Route::post('/garment/checkbarcode_store', 'ControllerGarment@garment_checkbarcode_store');

Route::get('/defect', 'ControllerDefect@index');
Route::get('/defect_new/{garment_name}', 'ControllerDefect@newdefect');
Route::post('/defect_insert', 'ControllerDefect@insert');
Route::get('/defect/edit/{id}', 'ControllerDefect@edit');
Route::get('/defect/by_garment/{garment_name}', 'ControllerDefect@by_garment');
Route::get('/defect/delete/{id}', 'ControllerDefect@delete');
Route::post('/defect/delete/{id}', 'ControllerDefect@delete');

// Import
Route::get('/import', 'ControllerImport@index');
Route::post('/import2', 'ControllerImport@postImportUser');
Route::post('/import3', 'ControllerImport@postImportRoll');
Route::post('/import4', 'ControllerImport@postImportUserRole');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

