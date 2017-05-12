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
Route::get('customers','Customers_controller@index');
Route::get('salesman','Salesman_controller@index');
Route::get('users','Users_controller@index');
Route::get('suppliers','Suppliers_controller@index');
Route::get('reports','Reports_controller@index');
Route::get('receivables/{tab}','Ar_controller@index');
Route::get('receivables','Ar_controller@index');
Route::get('payables','Ap_controller@index');
Route::get('expenses','Expenses_controller@index');