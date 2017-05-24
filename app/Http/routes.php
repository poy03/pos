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
Route::get('items/{id}','Items_controller@show');
Route::put('items/{id}','Items_controller@update');
Route::post('items','Items_controller@store');

Route::get('customers','Customers_controller@index');
Route::get('customers/list','Customers_controller@get_list');
Route::get('customers/{customer}','Customers_controller@show');
Route::put('customers/{customer}','Customers_controller@update');
Route::post('customers','Customers_controller@store');

Route::get('salesman','Salesman_controller@index');
Route::get('users','Users_controller@index');
Route::get('suppliers','Suppliers_controller@index');
Route::get('reports','Reports_controller@index');
Route::get('receivables/{tab}','Ar_controller@index');
Route::get('receivables','Ar_controller@index');
Route::get('payables','Ap_controller@index');
Route::get('expenses','Expenses_controller@index');
