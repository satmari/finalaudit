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

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

