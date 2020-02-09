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
		Route::get('/city-validate', 'CityController@cityValidate')->name('city-validate');
		Route::post('/store', 'CityController@store')->name('store-city');
		Route::get('/edit/{id}', 'CityController@edit')->name('edit-city');
	    Route::get('/delete/{id}', 'CityController@destroy')->name('delete-city');
	});

	Route::prefix('categories')->group(function() {
		Route::get('/', 'CategoryController@index')->name('categories');
	    Route::get('/category-validate', 'CategoryController@categoryValidate')->name('category-validate');
	    Route::post('/get-data', 'CategoryController@getData')->name('get-data');
	    Route::post('/store', 'CategoryController@store')->name('store-category');
	    Route::get('/edit/{id}', 'CategoryController@edit')->name('edit-category');
	    Route::get('/delete/{id}', 'CategoryController@destroy')->name('delete-category');
	});

	Route::prefix('items')->group(function() {
		Route::get('/', 'ItemController@index')->name('items');
		Route::get('/item-validate', 'ItemController@itemValidate')->name('item-validate');
	    Route::post('/get-data', 'ItemController@getData')->name('get-data');
	    Route::post('/store', 'ItemController@store')->name('store-item');
	    Route::get('/edit/{id}', 'ItemController@edit')->name('edit-item');
	    Route::get('/delete/{id}', 'ItemController@destroy')->name('delete-item');
	});

	Route::prefix('units')->group(function() {
		Route::get('/', 'UnitController@index')->name('units');
		Route::post('/get-data', 'UnitController@getData')->name('get-data');
		Route::get('/unit-validate', 'UnitController@unitValidate')->name('unit-validate');
		Route::post('/store', 'UnitController@store')->name('store-unit');
		Route::get('/edit/{id}', 'UnitController@edit')->name('edit-unit');
	    Route::get('/delete/{id}', 'UnitController@destroy')->name('delete-unit');
	});

	Route::prefix('customers')->group(function() {
		Route::get('/', 'CustomerController@index')->name('customers');
		Route::post('/get-data', 'CustomerController@getData')->name('get-data');
		Route::get('/email-validate', 'CustomerController@emailValidate')->name('email-validate');
		Route::post('/store', 'CustomerController@store')->name('store-customer');
		Route::get('/edit/{id}', 'CustomerController@edit')->name('edit-customer');
	    Route::get('/delete/{id}', 'CustomerController@destroy')->name('delete-customer');
	});

	Route::prefix('suppliers')->group(function() {
		Route::get('/', 'SupplierController@index')->name('suppliers');
		Route::post('/get-data', 'SupplierController@getData')->name('get-data');
		Route::get('/email-validate', 'SupplierController@emailValidate')->name('email-validate');
		Route::post('/store', 'SupplierController@store')->name('store-supplier');
		Route::get('/edit/{id}', 'SupplierController@edit')->name('edit-supplier');
	    Route::get('/delete/{id}', 'SupplierController@destroy')->name('delete-supplier');
	});
});