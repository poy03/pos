<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests;
use App\Salesman;

class Salesman_controller extends Controller
{
   public function index($value='')
   {
   		return view('salesman');
   }

   public function store(Request $request)
   {
   	$this->validate($request, [
   	    'salesman_name' => 'required|max:150|available:tbl_salesman,salesman_name',
   	    'salesman_contact_number' => 'max:150',
   	    'salesman_address' => 'max:150',
   	]);


   	$salesman = new Salesman;
   	$salesman->salesman_name = htmlspecialchars(trim($request->salesman_name));
   	$salesman->salesman_address = htmlspecialchars(trim($request->salesman_address));
    $salesman->salesman_contact_number = htmlspecialchars(trim($request->salesman_contact_number));

   	$salesman->save();
   	return $salesman->orderBy("salesmanID","DESC")->first();
   }

   public function get_list(Request $request)
   {
       DB::enableQueryLog();
       $page = $request->page;
       $maxitem = $request->maxitem;
       $limit = ($page*$maxitem)-$maxitem;
       $salesman = new Salesman;
       $result = $salesman->where('deleted', 0)
          ->orderBy('salesman_name', 'ASC')
          ->skip($limit)
          ->take($maxitem)
          ->get();
       foreach ($result as $salesman_data) {
           $salesman_data->salesman_name = $salesman_data->salesman_name;
           $salesman_data->salesman_address = $salesman_data->salesman_address;
           $salesman_data->salesman_contact_number = $salesman_data->salesman_contact_number;
       }
       $data["getQueryLog"] = DB::getQueryLog();
       $data["result"] = $result;
       $data["count"] = $salesman->where('deleted', 0)
           ->orderBy('salesman_name', 'ASC')
           ->count();

       return $data;
   }

   public function show($salesmanID)
   {
       $salesman = new Salesman;
       $data = $salesman->where('salesmanID',$salesmanID)->first();
       $data->salesman_name = htmlspecialchars_decode($data->salesman_name);
       $data->salesman_address = htmlspecialchars_decode($data->salesman_address);
       $data->salesman_contact_number = htmlspecialchars_decode($data->salesman_contact_number);
       return $data;
   }

   public function update($salesmanID,Request $request)
   {
      $this->validate($request, [
        'salesman_name' => 'required|max:150|available:tbl_salesman,salesman_name,salesmanID'.$salesmanID,
        'salesman_contact_number' => 'max:150',
        'salesman_address' => 'max:150',
      ]);
       $salesman = new salesman;
       $salesman
       ->where('salesmanID',$salesmanID)
       ->update([
           'salesman_name' => htmlspecialchars(trim($request->salesman_name)),
           'salesman_address' => htmlspecialchars(trim($request->salesman_address)),
           'salesman_contact_number' => htmlspecialchars(trim($request->salesman_contact_number)),
           ]);
       return $salesman->where('salesmanID',$salesmanID)->first();
   }

}
