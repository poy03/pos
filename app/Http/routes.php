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

Route::get('login', function () {
    return view('login');
});
Route::post('login','App_controller@login');
Route::post('settings','App_controller@settings');
Route::get('logout','App_controller@logout');
Route::get('test','App_controller@test');
Route::post('test','App_controller@test');

Route::get('/', 'App_controller@index')->middleware('logged');

Route::get('items','Items_controller@index')->middleware('logged');
Route::get('items/list','Items_controller@get_list')->middleware('logged.request');
Route::get('items/item/{id}','Items_controller@show')->middleware('logged.request');
Route::put('items/item/{id}','Items_controller@update')->middleware('logged.request');
Route::post('items','Items_controller@store')->middleware('logged.request');
Route::get('items/categories','Items_controller@get_categories')->middleware('logged.request');

Route::get('customers','Customers_controller@index')->middleware('logged');
Route::get('customers/list','Customers_controller@get_list')->middleware('logged.request');
Route::get('customers/customer/{id}','Customers_controller@show')->middleware('logged.request');
Route::put('customers/customer/{id}','Customers_controller@update')->middleware('logged.request');
Route::post('customers','Customers_controller@store')->middleware('logged.request');
Route::get('customers/companynames','Customers_controller@get_companynames')->middleware('logged.request');

Route::get('salesman','Salesman_controller@index')->middleware('logged');
Route::get('salesman/list','Salesman_controller@get_list')->middleware('logged.request');
Route::get('salesman/salesman/{id}','Salesman_controller@show')->middleware('logged.request');
Route::put('salesman/salesman/{id}','Salesman_controller@update')->middleware('logged.request');
Route::post('salesman','Salesman_controller@store')->middleware('logged.request');
Route::get('salesman/names','Salesman_controller@get_names')->middleware('logged.request');


Route::get('suppliers','Suppliers_controller@index')->middleware('logged');
Route::get('suppliers/list','Suppliers_controller@get_list')->middleware('logged.request');
Route::get('suppliers/supplier/{id}','Suppliers_controller@show')->middleware('logged.request');
Route::put('suppliers/supplier/{id}','Suppliers_controller@update')->middleware('logged.request');
Route::post('suppliers','Suppliers_controller@store')->middleware('logged.request');
Route::get('suppliers/suppliers','Suppliers_controller@get_suppliers')->middleware('logged.request');


Route::get('users','Users_controller@index')->middleware('logged');
Route::get('users/list','Users_controller@get_list')->middleware('logged.request');
Route::get('users/user/{id}','Users_controller@show')->middleware('logged.request');
Route::put('users/user/{id}','Users_controller@update')->middleware('logged.request');
Route::post('users','Users_controller@store')->middleware('logged.request');

Route::get('reports','Reports_controller@index')->middleware('logged');
Route::get('receivables/ar','Ar_controller@index')->middleware('logged');
Route::get('receivables/ar/list','Ar_controller@ar_list')->middleware('logged');
Route::get('receivables/due','Ar_controller@index')->middleware('logged');
Route::get('receivables','Ar_controller@index')->middleware('logged');


Route::get('payables','Ap_controller@index')->middleware('logged');
Route::get('expenses','Expenses_controller@index')->middleware('logged');

Route::get('sales','Sales_controller@index')->middleware('logged');
Route::post('sales','Sales_controller@dr_create')->middleware('logged.request');
Route::get('sales/drcart_t','Sales_controller@drcart_t')->middleware('logged.request');
Route::get('sales/drcart_d','Sales_controller@drcart_d')->middleware('logged.request');
Route::get('sales/drcart','Sales_controller@drcart')->middleware('logged.request');
Route::put('sales/drcart','Sales_controller@drcart_update')->middleware('logged.request');
Route::post('sales/drcart','Sales_controller@drcart_store')->middleware('logged.request');
Route::delete('sales/drcart','Sales_controller@drcart_destroy')->middleware('logged.request');
Route::get('sales/dr/{id}','Sales_controller@dr')->middleware('logged.request');
Route::put('sales/dr/{id}','Sales_controller@dr_updateinfo')->middleware('logged.request');
Route::post('sales/payment/{type}','Sales_controller@dr_payment')->middleware('logged.request');


Route::get('search/items/{arg}','Search_controller@items')->middleware('logged.request');
Route::get('search/customers/{arg}','Search_controller@customers')->middleware('logged.request');
Route::get('search/salesman/{arg}','Search_controller@salesman')->middleware('logged.request');
