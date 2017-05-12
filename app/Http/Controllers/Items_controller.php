<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Items_controller extends Controller
{
    public function index($value='')
    {
    	 return view('items');
    }
}
