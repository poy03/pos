<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Suppliers_controller extends Controller
{
    public function index($value='')
    {
    	return view("suppliers");
    }
}