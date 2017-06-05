<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Validator;
use App\Customers;
use App\Users;

class Customers_controller extends Controller
{
    public function index(Request $request)
    {
        $users = new Users;
        $data["user_data"] = $users->where("accountID",$request->session()->get('user'))->first();
        return view('customers',$data);
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    	    'companyname' => 'required|max:100|available:tbl_customer,companyname',
    	    'address' => 'max:50',
    	    'email' => 'email|max:50',
    	    'phone' => 'max:50',
    	    'contactperson' => 'max:50',
    	    'tin_id' => 'max:200',
            'credit_limit' => 'numeric',
    	    'term' => 'numeric',
    	]);


    	$customers = new Customers;
    	$customers->companyname = htmlspecialchars(trim($request->companyname));
    	$customers->address = htmlspecialchars(trim($request->address));
        $customers->email = htmlspecialchars(trim($request->email));
        $customers->phone = htmlspecialchars(trim($request->phone));
        $customers->contactperson = htmlspecialchars(trim($request->contactperson));
        $customers->tin_id = htmlspecialchars(trim($request->tin_id));
        $customers->credit_limit = $request->credit_limit;
    	$customers->term = $request->term;

    	$customers->save();
    	return $customers->orderBy("customerID","DESC")->first();
    }

    public function get_list(Request $request)
    {
        DB::enableQueryLog();
        $page = $request->page;
        $maxitem = $request->maxitem;
        $limit = ($page*$maxitem)-$maxitem;
        $customers = new Customers;
        $result = $customers->where('deleted', 0);
        $result->orderBy('companyname', 'ASC');
        if($request->customerID){
            $result->where('customerID', $request->customerID);
        }
        $result->skip($limit);
        $result->take($maxitem);
        $result = $result->get();
        $result_count = $result->count();
        foreach ($result as $customer_data) {
            $customer_data->companyname = $customer_data->companyname;
            $customer_data->address = $customer_data->address;
            $customer_data->email = $customer_data->email;
            $customer_data->phone = $customer_data->phone;
            $customer_data->contactperson = $customer_data->contactperson;
            $customer_data->tin_id = $customer_data->tin_id;
            $customer_data->credit_limit = number_format($customer_data->credit_limit,2);
            $customer_data->term = number_format($customer_data->term);
        }
        $data["getQueryLog"] = DB::getQueryLog();
        $data["result"] = $result;
        $count = $customers->where('deleted', 0);
        $count->orderBy('companyname', 'ASC');
        if($request->customerID){
            $count->where('customerID', $request->customerID);
        }
        $count = ($result_count==0?0:$count->count());
        $data["paging"] = paging($page,$count,$maxitem);
        return $data;
    }

    public function get_companynames()
    {
        $customers = new Customers;
        return $customers->select("companyname","customerID")->where("deleted",0)->get();
    }

    public function show($customerID)
    {
        $customers = new Customers;
        $data = $customers->where('customerID',$customerID)->first();
        $data->companyname = htmlspecialchars_decode($data->companyname);
        $data->address = htmlspecialchars_decode($data->address);
        $data->email = htmlspecialchars_decode($data->email);
        $data->phone = htmlspecialchars_decode($data->phone);
        $data->contactperson = htmlspecialchars_decode($data->contactperson);
        $data->tin_id = htmlspecialchars_decode($data->tin_id);
        return $data;
    }
    public function update($customerID,Request $request)
    {
        $this->validate($request, [
            'companyname' => 'required|max:100|available:tbl_customer,companyname,customerID,'.$customerID,
            'address' => 'max:50',
            'email' => 'email|max:50',
            'phone' => 'max:50',
            'contactperson' => 'max:50',
            'tin_id' => 'max:200',
            'credit_limit' => 'numeric',
            'term' => 'numeric',
        ]);
        $customers = new Customers;
        $customers
        ->where('customerID',$customerID)
        ->update([
            'companyname' => htmlspecialchars(trim($request->companyname)),
            'address' => htmlspecialchars(trim($request->address)),
            'email' => htmlspecialchars(trim($request->email)),
            'phone' => htmlspecialchars(trim($request->phone)),
            'contactperson' => htmlspecialchars(trim($request->contactperson)),
            'tin_id' => htmlspecialchars(trim($request->tin_id)),
            'credit_limit' => htmlspecialchars(trim($request->credit_limit)),
            'term' => htmlspecialchars(trim($request->term)),
            ]);
        return $customers->where('customerID',$customerID)->first();
    }
}
