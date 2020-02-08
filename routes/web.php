<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => ['auth']], function ()
{
	Route::get('/home', 'HomeController@index')->name('home');

	Route::prefix('purchases')->group(function() {
		Route::get('/', 'PurchaseController@index')->name('purchases');
	});

	Route::prefix('sales')->group(function() {
		Route::get('/', 'SaleController@index')->name('sales');
	});

	Route::prefix('reports')->group(function() {
		Route::get('/', 'ReportController@index')->name('reports');
	});

	Route::prefix('cities')->group(function() {
		Route::get('/', 'CityController@index')->name('cities');
		Route::post('/get-data', 'CityController@getData')->name('get-data');
	});

	Route::prefix('categories')->group(function() {
		Route::get('/', 'CategoryController@index')->name('categories');
	});

	Route::prefix('items')->group(function() {
		Route::get('/', 'ItemController@index')->name('items');
	});

	Route::prefix('units')->group(function() {
		Route::get('/', 'UnitController@index')->name('units');
	});

	Route::prefix('customers')->group(function() {
		Route::get('/', 'CustomerController@index')->name('customers');
	});

	Route::prefix('suppliers')->group(function() {
		Route::get('/', 'SupplierController@index')->name('suppliers');
	});
});