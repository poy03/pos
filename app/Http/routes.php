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

Route::get('/', function () {
    return view('home');
});

Route::get('items','Items_controller@index');
Route::get('items/list','Items_controller@get_list');
Route::get('items/item/{id}','Items_controller@show');
Route::put('items/item/{id}','Items_controller@update');
Route::post('items','Items_controller@store');
Route::get('items/categories','Items_controller@get_categories');

Route::get('customers','Customers_controller@index');
Route::get('customers/list','Customers_controller@get_list');
Route::get('customers/customer/{id}','Customers_controller@show');
Route::put('customers/customer/{id}','Customers_controller@update');
Route::post('customers','Customers_controller@store');
Route::get('customers/companynames','Customers_controller@get_companynames');

Route::get('salesman','Salesman_controller@index');
Route::get('salesman/list','Salesman_controller@get_list');
Route::get('salesman/salesman/{id}','Salesman_controller@show');
Route::put('salesman/salesman/{id}','Salesman_controller@update');
Route::post('salesman','Salesman_controller@store');
Route::get('salesman/names','Salesman_controller@get_names');


Route::get('suppliers','Suppliers_controller@index');
Route::get('suppliers/list','Suppliers_controller@get_list');
Route::get('suppliers/supplier/{id}','Suppliers_controller@show');
Route::put('suppliers/supplier/{id}','Suppliers_controller@update');
Route::post('suppliers','Suppliers_controller@store');
Route::get('suppliers/suppliers','Suppliers_controller@get_suppliers');


Route::get('users','Users_controller@index');
Route::get('users/list','Users_controller@get_list');
Route::get('users/user/{id}','Users_controller@show');
Route::put('users/user/{id}','Users_controller@update');
Route::post('users','Users_controller@store');

Route::get('reports','Reports_controller@index');
Route::get('receivables/{tab}','Ar_controller@index');
Route::get('receivables','Ar_controller@index');
Route::get('payables','Ap_controller@index');
Route::get('expenses','Expenses_controller@index');

Route::get('sales','Sales_controller@index');
Route::get('sales/drcart_t','Sales_controller@drcart_t');
Route::get('sales/drcart_d','Sales_controller@drcart_d');
Route::get('sales/drcart','Sales_controller@drcart');
Route::put('sales/drcart','Sales_controller@drcart_update');
Route::post('sales/drcart','Sales_controller@drcart_store');
Route::delete('sales/drcart','Sales_controller@drcart_destroy');


Route::get('search/items/{arg}','Search_controller@items');
Route::get('search/customers/{arg}','Search_controller@customers');
Route::get('search/salesman/{arg}','Search_controller@salesman');
