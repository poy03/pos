<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Ar_controller extends Controller
{
    public function index($tab="ar")
    {
    	if($tab!="ar" && $tab!="due" && $tab!="30due" && $tab!="60due" && $tab!="61due" && $tab!="cashpaid" && $tab!="pdcpaid"){
    		abort(404);
    	}else{
	    	return view("ar",["tab"=>$tab]);
    	}
    }
}
