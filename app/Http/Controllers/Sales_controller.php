<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests;

class Sales_controller extends Controller
{
    public function index($value='')
    {
    	return view('sales');
    }

    public function drcart_add($value='')
    {
    	
    }
}
