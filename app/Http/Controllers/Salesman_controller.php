<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use App\Http\Requests;
use App\Salesman;
use App\Users;

class Salesman_controller extends Controller
{
   public function index(Request $request)
   {
      $users = new Users;
      $data["user_data"] = $users->where("accountID",$request->session()->get('user'))->first();
   		return view('salesman',$data);
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
    $result = $salesman->where('deleted', 0);
    $result->orderBy('salesman_name', 'ASC');
    if($request->salesmanID){
      $result->where("salesmanID",$request->salesmanID);
    }
    $result->skip($limit);
    $result->take($maxitem);
    $result = $result->get();
    $result_count = $result->count();
    foreach ($result as $salesman_data) {
       $salesman_data->salesman_name = $salesman_data->salesman_name;
       $salesman_data->salesman_address = $salesman_data->salesman_address;
       $salesman_data->salesman_contact_number = $salesman_data->salesman_contact_number;
    }
    $data["getQueryLog"] = DB::getQueryLog();
    $data["result"] = $result;
    $count = $salesman->where('deleted', 0);
    if($request->salesmanID){
      $count->where("salesmanID",$request->salesmanID);
    }
    $count->orderBy('salesman_name', 'ASC');
    $count = ($result_count==0?0:$count->count());
    $data["paging"] = paging($page,$count,$maxitem);

    return $data;
   }

   public function get_names()
   {
    $salesman = new Salesman;
    return $salesman->select("salesman_name","salesmanID")->where("deleted",0)->get();
   }

   public function show($salesmanID)
   {
    $salesman = new Salesman;
    $data = $salesman->where('salesmanID',$salesmanID);
    if($data->count()==0){
      abort(404);
    }
    $data = $data->first();
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
